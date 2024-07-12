<!-- resources/views/officer/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Officer Dashboard') }}</h1>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-2">Welcome, Officer {{ Auth::guard('officer')->user()->name }}</h2>
        <p class="mb-4 text-gray-600">NIP: {{ Auth::guard('officer')->user()->nip }}</p>

        <h3 class="text-lg font-semibold mb-2">Quick Actions</h3>
        <ul class="list-disc pl-5 mb-4 space-y-2">
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Submit Report</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">View Assignments</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Update Profile</a></li>
        </ul>

        <!-- You can add more sections here as needed -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-2">Recent Activities</h3>
            <div class="bg-gray-100 p-4 rounded">
                <p class="text-gray-600">No recent activities to display.</p>
                <!-- You can replace this with actual recent activities data -->
            </div>
        </div>
    </div>
</div>
@endsection
