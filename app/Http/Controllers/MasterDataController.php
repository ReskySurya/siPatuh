<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Officer;
use Illuminate\Support\Facades\Log;

class MasterDataController extends Controller
{
    public function index()
    {
        $users = User::all();
        $officers = Officer::all();
        return view('masterdata', compact('users', 'officers'));
    }

    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'image_signature' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];

        if ($request->hasFile('image_signature')) {
            $image = $request->file('image_signature');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('signatures'), $imageName);
            $user->image_signature = 'signatures/' . $imageName;
        }

        $user->save();

        return redirect()->route('masterdata.index')->with('success', 'User baru berhasil ditambahkan');
    }

    public function addOfficer(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'image_signature' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $officer = new Officer();
        $officer->name = $validatedData['name'];
        $officer->email = $validatedData['email'];
        $officer->nip = $validatedData['nip'];
        $officer->password = bcrypt($validatedData['password']);
        $officer->role = $validatedData['role'];

        if ($request->hasFile('image_signature')) {
            $image = $request->file('image_signature');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('signatures'), $imageName);
            $officer->image_signature = 'signatures/' . $imageName;
        }

        $officer->save();

        return redirect()->route('masterdata.index')->with('success', 'Officer baru berhasil ditambahkan');
    }

    public function editOfficer(Request $request, $id)
    {
        $officer = Officer::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'nip' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:officers,email,'.$id,
            'role' => 'sometimes|required|string',
            'image_signature' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        foreach ($validatedData as $key => $value) {
            if ($key === 'image_signature' && $request->hasFile('image_signature')) {
                // Hapus tanda tangan lama jika ada
                if ($officer->image_signature) {
                    unlink(public_path($officer->image_signature));
                }

                $image = $request->file('image_signature');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('signatures'), $imageName);
                $officer->image_signature = 'signatures/' . $imageName;
            } else {
                $officer->$key = $value;
            }
        }

        $officer->save();

        return response()->json(['success' => true]);
    }

    public function deleteOfficer($id)
    {
        $officer = Officer::findOrFail($id);

        // Hapus tanda tangan jika ada
        if ($officer->image_signature) {
            unlink(public_path($officer->image_signature));
        }

        $officer->delete();

        return redirect()->route('masterdata.index')->with('success', 'Officer berhasil dihapus');
    }

    public function getOfficer($id)
    {
        try {
            $officer = Officer::findOrFail($id);
            $officerArray = $officer->toArray();

            // Bersihkan data dari karakter yang tidak valid
            array_walk_recursive($officerArray, function (&$item) {
                if (!mb_detect_encoding($item, 'UTF-8', true)) {
                    $item = utf8_encode($item);
                }
            });

            return response()->json($officerArray);
        } catch (\Exception $e) {
            Log::error('Error fetching officer: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data officer: ' . $e->getMessage()], 500);
        }
    }

    public function getUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $userArray = $user->toArray();

            // Bersihkan data dari karakter yang tidak valid
            array_walk_recursive($userArray, function (&$item) {
                if (!mb_detect_encoding($item, 'UTF-8', true)) {
                    $item = utf8_encode($item);
                }
            });

            return response()->json($userArray);
        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data user: ' . $e->getMessage()], 500);
        }
    }

    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:superadmin,supervisor',
            'image_signature' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->update($validatedData);

        foreach ($validatedData as $key => $value) {
            if ($key === 'image_signature' && $request->hasFile('image_signature')) {
                // Hapus tanda tangan lama jika ada
                if ($user->image_signature) {
                    unlink(public_path($user->image_signature));
                }

                $image = $request->file('image_signature');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('signatures'), $imageName);
                $user->image_signature = 'signatures/' . $imageName;
            } else {
                $user->$key = $value;
            }
        }

        $user->save();

        return response()->json(['success' => true]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Hapus tanda tangan jika ada
        if ($user->image_signature) {
            unlink(public_path($user->image_signature));
        }

        $user->delete();

        return redirect()->route('masterdata.index')->with('success', 'User berhasil dihapus');
    }
}
