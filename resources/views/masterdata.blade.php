@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Data Master Pengguna') }}</h1>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Tab Navigation -->
        <div class="flex gap-4 mb-6 border-b">
            <button onclick="switchTab('user')" id="userTab"
                class="px-6 py-3 font-medium rounded-t-lg transition-colors duration-200">
                Data User
            </button>
            <button onclick="switchTab('officer')" id="officerTab"
                class="px-6 py-3 font-medium rounded-t-lg transition-colors duration-200">
                Data Officer
            </button>
        </div>

        <!-- User Content -->
        <div id="userContent" class="tab-content">
            <div class="mb-4">
                <button onclick="toggleModal('addUserModal')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah User
                </button>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <!-- Tampilan desktop -->
                <table class="min-w-full divide-y divide-gray-200 hidden sm:table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->nip }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                <button onclick="editUser({{ $user->id }})"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                                <form action="{{ route('masterdata.deleteUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tampilan mobile -->
                <div class="sm:hidden">
                    @foreach($users as $user)
                    <div class="bg-white p-4 border-b">
                        <div class="mb-2">
                            <label class="font-bold text-gray-700">Nama:</label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="font-bold text-gray-700">Email:</label>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="font-bold text-gray-700">NIP:</label>
                            <p>{{ $user->nip }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="font-bold text-gray-700">Peran:</label>
                            <p>{{ $user->role }}</p>
                        </div>
                        <div class="flex gap-2 mt-3">
                            <button onclick="editUser({{ $user->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded flex items-center gap-1 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('masterdata.deleteUser', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-1 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Officer Content -->
        <div id="officerContent" class="tab-content hidden">
            <div class="mb-4">
                <button onclick="toggleModal('addOfficerModal')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Officer
                </button>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <!-- Tampilan desktop -->
                <table class="min-w-full divide-y divide-gray-200 hidden sm:table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($officers as $officer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $officer->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $officer->nip }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $officer->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                <button onclick="editOfficer({{ $officer->id }})"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                                <form action="{{ route('masterdata.deleteOfficer', $officer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus officer ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tampilan mobile -->
                <div class="sm:hidden">
                    @foreach($officers as $officer)
                    <div class="bg-white p-4 border-b">
                        <div class="mb-2">
                            <label class="font-bold text-gray-700">Nama:</label>
                            <p>{{ $officer->name }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="font-bold text-gray-700">NIP:</label>
                            <p>{{ $officer->nip }}</p>
                        </div>
                        <div class="mb-2">
                            <label class="font-bold text-gray-700">Email:</label>
                            <p>{{ $officer->email }}</p>
                        </div>
                        <div class="flex gap-2 mt-3">
                            <button onclick="editOfficer({{ $officer->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded flex items-center gap-1 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('masterdata.deleteOfficer', $officer->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus officer ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-1 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menambah user -->
<div id="addUserModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full opacity-0"
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
                <label for="nip" class="block text-gray-700 text-sm font-bold mb-2">NIP:</label>
                <input type="text" id="nip" name="nip" required
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
            <button type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
        </form>
    </div>
</div>

<!-- Modal untuk menambah officer -->
<div id="addOfficerModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full opacity-0"
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
            <button type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
        </form>
    </div>
</div>

<!-- Modal untuk mengedit officer -->
<div id="editOfficerModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <span class="close absolute top-0 right-0 p-4 cursor-pointer" onclick="toggleModal('editOfficerModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit Officer</h2>
        <form id="editOfficerForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit_name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                <input type="text" id="edit_name" name="name" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_nip" class="block text-gray-700 text-sm font-bold mb-2">NIP:</label>
                <input type="text" id="edit_nip" name="nip" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="edit_email" name="email" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="button" id="submitEditOfficer"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
        </form>
    </div>
</div>

<!-- Modal untuk mengedit user -->
<div id="editUserModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <span class="close absolute top-0 right-0 p-4 cursor-pointer" onclick="toggleModal('editUserModal')">&times;</span>
        <h2 class="text-xl font-bold mb-4">Edit User</h2>
        <form id="editUserForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit_user_name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                <input type="text" id="edit_user_name" name="name" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_user_email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="edit_user_email" name="email" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_user_nip" class="block text-gray-700 text-sm font-bold mb-2">NIP:</label>
                <input type="text" id="edit_user_nip" name="nip" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="edit_user_role" class="block text-gray-700 text-sm font-bold mb-2">Peran:</label>
                <select id="edit_user_role" name="role" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="superadmin">SuperAdmin</option>
                    <option value="supervisor">Supervisor</option>
                </select>
            </div>
            <button type="button" id="submitEditUser"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
        </form>
    </div>
</div>

<!-- Script untuk menangani modal -->
<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            if (modal.style.display === "none" || !modal.style.display) {
                // Tampilkan modal
                modal.style.display = "block";
                // Reset form saat modal dibuka
                const form = modal.querySelector('form');
                if (form) {
                    form.reset();
                }
                // Tambahkan class untuk animasi fade in
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
            } else {
                // Sembunyikan modal dengan animasi fade out
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.style.display = "none";
                }, 300);
            }
        }
    }

    // Event listener untuk menutup modal saat klik di luar modal
    window.onclick = function(event) {
        const modals = document.getElementsByClassName('modal');
        Array.from(modals).forEach(modal => {
            if (event.target === modal) {
                toggleModal(modal.id);
            }
        });
    }

    // Event listener untuk tombol close di modal
    document.addEventListener('DOMContentLoaded', function() {
        const closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal');
                if (modal) {
                    toggleModal(modal.id);
                }
            });
        });
    });

    let currentOfficerId = null;

    function editOfficer(id) {
        currentOfficerId = id;
        // Ambil data officer dari server
        fetch(`/masterdata/officer/${id}`)
            .then(response => response.json())
            .then(data => {
                // Isi form dengan data yang ada
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_nip').value = data.nip;
                document.getElementById('edit_email').value = data.email;

                // Tampilkan modal
                const modal = document.getElementById('editOfficerModal');
                modal.style.display = "block";
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                }, 10);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data officer');
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const editOfficerForm = document.getElementById('editOfficerForm');
        const submitEditOfficerButton = document.getElementById('submitEditOfficer');

        if (editOfficerForm && submitEditOfficerButton) {
            editOfficerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('_method', 'PUT');

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
                        alert('Data officer berhasil diperbarui');
                        toggleModal('editOfficerModal');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat memperbarui data officer');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui data officer');
                });
            });

            submitEditOfficerButton.addEventListener('click', function(e) {
                e.preventDefault();
                editOfficerForm.dispatchEvent(new Event('submit'));
            });
        }
    });

    let currentUserId = null;

    function editUser(id) {
        currentUserId = id;
        // Ambil data user dari server
        fetch(`/masterdata/user/${id}`)
            .then(response => response.json())
            .then(data => {
                // Isi form dengan data yang ada
                document.getElementById('edit_user_name').value = data.name;
                document.getElementById('edit_user_email').value = data.email;
                document.getElementById('edit_user_nip').value = data.nip;
                document.getElementById('edit_user_role').value = data.role;

                // Tampilkan modal
                const modal = document.getElementById('editUserModal');
                modal.style.display = "block";
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                }, 10);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data user');
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const editUserForm = document.getElementById('editUserForm');
        const submitEditUserButton = document.getElementById('submitEditUser');

        if (editUserForm && submitEditUserButton) {
            editUserForm.addEventListener('submit', function(e) {
                e.preventDefault();
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
        }
    });

    // Fungsi untuk switch tab
    function switchTab(tabName) {
        const userTab = document.getElementById('userTab');
        const officerTab = document.getElementById('officerTab');
        const userContent = document.getElementById('userContent');
        const officerContent = document.getElementById('officerContent');

        if (tabName === 'user') {
            userTab.classList.remove('bg-gray-100', 'text-gray-600');
            userTab.classList.add('bg-white', 'text-gray-900');
            officerTab.classList.remove('bg-white', 'text-gray-900');
            officerTab.classList.add('bg-gray-100', 'text-gray-600');
            userContent.classList.remove('hidden');
            officerContent.classList.add('hidden');
        } else {
            officerTab.classList.remove('bg-gray-100', 'text-gray-600');
            officerTab.classList.add('bg-white', 'text-gray-900');
            userTab.classList.remove('bg-white', 'text-gray-900');
            userTab.classList.add('bg-gray-100', 'text-gray-600');
            officerContent.classList.remove('hidden');
            userContent.classList.add('hidden');
        }
    }

    // Set tab default saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        switchTab('user');
    });
</script>

<style>
    .modal {
        transition: opacity 0.3s ease-in-out;
    }

    .modal-content {
        transform: scale(0.95);
        transition: transform 0.3s ease-in-out;
    }

    .modal.opacity-100 .modal-content {
        transform: scale(1);
    }

    @media (max-width: 400px) {
        .modal-content {
            width: 95%;
            margin: 10px;
            padding: 15px;
            top: 5%;
        }

        .container {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        input, select {
            font-size: 14px;
            padding: 6px 10px;
        }

        button {
            padding: 6px 12px;
            font-size: 14px;
        }

        .table-cell {
            padding: 8px;
        }

        h1 {
            font-size: 1.25rem;
        }

        .tab-navigation button {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>
@endsection
