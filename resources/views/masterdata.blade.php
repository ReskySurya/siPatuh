@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800">{{ __('Data Master Pengguna') }}</h1>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Tab Navigation -->
    <div class="flex border-b border-gray-200 mb-0 mt-4">
        <button onclick="switchTab('user')" id="userTab"
            class="px-6 py-3 text-sm font-medium rounded bg-white text-gray-900 border-t border-l border-r border-gray-200">
            Data User
        </button>
        <button onclick="switchTab('officer')" id="officerTab"
            class="px-6 py-3 text-sm font-medium rounded bg-gray-100 text-gray-600 hover:text-gray-900">
            Data Officer
        </button>
    </div>

    <!-- User Content -->
    <div id="userContent" class="tab-content">
        <!-- Your existing User table content here -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-2">
            <h2 class="text-2xl font-bold mb-4">Master Data User</h2>
            <button onclick="toggleModal('addUserModal')"
                class="bg-green-500 mb-2 text-white py-2 px-4 rounded flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah User
                </button>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Peran
                            </th>
                            {{-- <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanda Tangan
                            </th> --}}
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($users) && count($users) > 0)
                        @foreach($users as $user)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $user->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $user->role }}
                            </td>
                            {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($user->image_signature)
                                <img src="data:image/png;base64,{{ base64_encode($user->image_signature) }}"
                                    alt="Tanda Tangan" class="w-16 h-16">
                                @else
                                Tidak ada tanda tangan
                                @endif
                            </td> --}}
                            <td class="px-5 py-5 border-b flex flex-row gap-1 items-center border-gray-200 bg-white text-sm">
                                <button onclick="editUser({{ $user->id }})"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </button>
                                <form action="{{ route('masterdata.deleteUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                Tidak ada data user yang tersedia.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
        </div>
    </div>

    <!-- Officer Content -->
    <div id="officerContent" class="tab-content hidden">
        <!-- Your existing Officer table content here -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-2">
            <h2 class="text-2xl font-bold mb-4">Master Data Officer</h2>
            <button onclick="toggleModal('addOfficerModal')"
                class="bg-green-500 mb-2 text-white py-2 px-4 rounded flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Officer
            </button>
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th
                            class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama</th>
                        <th
                            class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            NIP</th>
                        <th
                            class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Peran</th>
                        {{-- <th
                            class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tanda Tangan</th> --}}
                        <th
                            class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-widerer">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($officers) && count($officers) > 0)
                    @foreach($officers as $officer)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $officer->name }}</td>
                        <td class="py-2 px-4">{{ $officer->nip }}</td>
                        <td class="py-2 px-4">{{ $officer->email }}</td>
                        <td class="py-2 px-4">{{ $officer->role }}</td>
                        {{-- <td class="py-2 px-4">
                            @if($officer->image_signature)
                            <img src="data:image/png;base64,{{ base64_encode($officer->image_signature) }}"
                                alt="Tanda Tangan" class="w-16 h-16">
                            @else
                            Tidak ada tanda tangan
                            @endif
                        </td> --}}
                        <td class="py-2 px-4 flex flex-row gap-1 items-center">
                            <button onclick="editOfficer({{ $officer->id }})"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('masterdata.deleteOfficer', $officer->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus officer ini?')"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            Tidak ada data officer yang tersedia.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk menambah user -->
    <div id="addUserModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
        style="display: none;">
        <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <span class="close absolute top-0 right-0 p-4 cursor-pointer"
                onclick="toggleModal('addUserModal')">&times;</span>
            <h2 class="text-xl font-bold mb-4">Tambah User Baru</h2>
            <form action="{{ route('masterdata.addUser') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                    <input type="text" id="name" name="name" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" required minlength="8"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Peran:</label>
                    <select id="role" name="role" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="superadmin">SuperAdmin</option>
                        <option value="supervisor">SuperVisor</option>
                    </select>
                </div>
                {{-- <div class="mb-4">
                    <label for="image_signature" class="block text-gray-700 text-sm font-bold mb-2">Tanda
                        Tangan:</label>
                    <input type="file" id="image_signature" name="image_signature" accept="image/*"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div> --}}
                <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
            </form>
        </div>
    </div>
</div>


<!-- Modal untuk menambah officer -->
<div id="addOfficerModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
    style="display: none;">
    <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <span class="close absolute top-0 right-0 p-4 cursor-pointer"
            onclick="toggleModal('addOfficerModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Tambah Officer Baru</h2>
        <form action="{{ route('masterdata.addOfficer') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                <input type="text" id="name" name="name" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="nip" class="block text-gray-700 text-sm font-bold mb-2">NIP:</label>
                <input type="text" id="nip" name="nip" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" required minlength="8"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Peran:</label>
                <select id="role" name="role" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="officer">Officer</option>
                </select>
            </div>
            {{-- <div class="mb-4">
                <label for="image_signature" class="block text-gray-700 text-sm font-bold mb-2">Tanda
                    Tangan:</label>
                <input type="file" id="image_signature" name="image_signature" accept="image/*"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div> --}}
            <button type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
        </form>
    </div>
</div>
</div>

<!-- Modal untuk mengedit officer -->
<div id="editOfficerModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
    style="display: none;">
    <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <span class="close absolute top-0 right-0 p-4 cursor-pointer"
            onclick="toggleModal('editOfficerModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit Officer</h2>
        <form id="editOfficerForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit_name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                <input type="text" id="edit_name" name="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_nip" class="block text-gray-700 text-sm font-bold mb-2">NIP:</label>
                <input type="text" id="edit_nip" name="nip"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="edit_email" name="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_role" class="block text-gray-700 text-sm font-bold mb-2">Peran:</label>
                <select id="edit_role" name="role"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="officer">Officer</option>
                </select>
            </div>
            {{-- <div class="mb-4">
                <label for="edit_image_signature" class="block text-gray-700 text-sm font-bold mb-2">Tanda
                    Tangan:</label>
                <input type="file" id="edit_image_signature" name="image_signature" accept="image/*"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div> --}}
            <button type="submit" id="submitEditOfficer"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan
                Perubahan</button>
        </form>
    </div>
</div>

<!-- Modal untuk mengedit user -->
<div id="editUserModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
    style="display: none;">
    <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <span class="close absolute top-0 right-0 p-4 cursor-pointer"
            onclick="toggleModal('editUserModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit User</h2>
        <form id="editUserForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit_user_name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                <input type="text" id="edit_user_name" name="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_user_email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="edit_user_email" name="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_user_role" class="block text-gray-700 text-sm font-bold mb-2">Peran:</label>
                <select id="edit_user_role" name="role"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="superadmin">SuperAdmin</option>
                    <option value="supervisor">SuperVisor</option>
                </select>
            </div>
            {{-- <div class="mb-4">
                <label for="edit_user_image_signature" class="block text-gray-700 text-sm font-bold mb-2">Tanda
                    Tangan:</label>
                <input type="file" id="edit_user_image_signature" name="image_signature" accept="image/*"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div> --}}
            <button type="submit" id="submitEditUser"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan
                Perubahan</button>
        </form>
    </div>
</div>
</div>

<!-- Script untuk menangani modal -->
<script>
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active state from all tabs
        document.getElementById('userTab').classList.remove('bg-white', 'text-gray-900', 'border-t', 'border-l', 'border-r');
        document.getElementById('userTab').classList.add('bg-gray-100', 'text-gray-600');
        document.getElementById('officerTab').classList.remove('bg-white', 'text-gray-900', 'border-t', 'border-l', 'border-r');
        document.getElementById('officerTab').classList.add('bg-gray-100', 'text-gray-600');

        // Show selected tab content and activate tab
        if (tabName === 'user') {
            document.getElementById('userContent').classList.remove('hidden');
            document.getElementById('userTab').classList.remove('bg-gray-100', 'text-gray-600');
            document.getElementById('userTab').classList.add('bg-white', 'text-gray-900', 'border-t', 'border-l', 'border-r');
        } else {
            document.getElementById('officerContent').classList.remove('hidden');
            document.getElementById('officerTab').classList.remove('bg-gray-100', 'text-gray-600');
            document.getElementById('officerTab').classList.add('bg-white', 'text-gray-900', 'border-t', 'border-l', 'border-r');
        }
    }

    function toggleModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal.style.display === "none") {
            modal.style.display = "block";
        } else {
            modal.style.display = "none";
        }
    }

    let currentOfficerId = null;

    function editOfficer(id) {
        currentOfficerId = id;
        // Ambil data officer dari server menggunakan AJAX
        fetch(`/masterdata/officer/${id}`)
            .then(response => response.json())
            .then(data => {
                // Isi form dengan data officer
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_nip').value = data.nip;
                document.getElementById('edit_email').value = data.email;
                document.getElementById('edit_role').value = data.role;

                // Tampilkan modal
                toggleModal('editOfficerModal');
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const editOfficerForm = document.getElementById('editOfficerForm');
        const submitEditOfficerButton = document.getElementById('submitEditOfficer');

        if (editOfficerForm && submitEditOfficerButton) {
            editOfficerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Form submitted'); // Tambahkan ini untuk debugging

                const formData = new FormData(this);
                formData.append('_method', 'PUT'); // Untuk metode spoofing di Laravel

                fetch(`/masterdata/officer/${currentOfficerId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data berhasil diperbarui');
                        toggleModal('editOfficerModal');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat memperbarui data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui data');
                });
            });

            // Tambahkan event listener untuk tombol submit
            submitEditOfficerButton.addEventListener('click', function(e) {
                e.preventDefault();
                editOfficerForm.dispatchEvent(new Event('submit'));
            });
        } else {
            console.error('Form atau tombol submit tidak ditemukan');
        }
    });

    let currentUserId = null;

    function editUser(id) {
        currentUserId = id;
        // Ambil data user dari server menggunakan AJAX
        fetch(`/masterdata/user/${id}`)
            .then(response => response.json())
            .then(data => {
                // Isi form dengan data user
                document.getElementById('edit_user_name').value = data.name;
                document.getElementById('edit_user_email').value = data.email;
                document.getElementById('edit_user_role').value = data.role;

                // Tampilkan modal
                toggleModal('editUserModal');
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const editUserForm = document.getElementById('editUserForm');
        const submitEditUserButton = document.getElementById('submitEditUser');

        if (editUserForm && submitEditUserButton) {
            editUserForm.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Form user submitted');

                const formData = new FormData(this);
                formData.append('_method', 'PUT');

                fetch(`/masterdata/user/${currentUserId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data user berhasil diperbarui');
                        toggleModal('editUserModal');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat memperbarui data user');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui data user');
                });
            });

            submitEditUserButton.addEventListener('click', function(e) {
                e.preventDefault();
                editUserForm.dispatchEvent(new Event('submit'));
            });
        } else {
            console.error('Form user atau tombol submit tidak ditemukan');
        }
    });
</script>
@endsection
