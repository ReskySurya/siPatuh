@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Dashboard') }}</h1>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-2">Welcome, {{ Auth::user()->name }}</h2>
        <p class="mb-4">Role: {{ Auth::user()->role }}</p>

        @if(Auth::user()->isSuperAdmin())
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                You have superadmin privileges.
            </div>
        @endif

        <h3 class="text-lg font-semibold mb-2">Quick Actions</h3>
        <ul class="list-disc pl-5 mb-4">
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Manage Users</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">View Reports</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">System Settings</a></li>
        </ul>
    </div>
</div>
@endsection
