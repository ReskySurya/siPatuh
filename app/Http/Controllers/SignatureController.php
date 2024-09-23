<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignatureController extends Controller
{
    public function showOfficer()
    {
        $officer = Auth::guard('officer')->user();
        if ($officer && $officer->officer_signature) { // Menggunakan officer_signature
            return response($officer->officer_signature)->header('Content-Type', 'image/png');
        }
        return response()->noContent(404);

    }

    public function showUser()
    {
        $user = Auth::user();
        if ($user && $user->supervisor_signature) { // Menggunakan supervisor_signature
            return response($user->supervisor_signature)->header('Content-Type', 'image/png');
        }
        return response()->noContent(404);

    }
}
