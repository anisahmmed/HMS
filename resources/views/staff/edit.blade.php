@extends('layouts.dashboard')

@section('sidebar')
<!-- Sidebar -->
<div class="w-64 bg-gradient-to-b from-indigo-600 via-purple-600 to-pink-600 text-white min-h-screen shadow-xl">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Hospital HMS</h2>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded hover:bg-white hover:bg-opacity-20 ">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctors.index') }}" class="flex items-center p-3 rounded hover:bg-white hover:bg-opacity-20 ">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Doctors
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.index') }}" class="flex items-center p-3 rounded bg-white bg-opacity-30">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Staff
                    </a>
                </li>
                <li>
                    <a href="{{ route('appointments.index') }}" class="flex items-center p-3 rounded hover:bg-white hover:bg-opacity-20 ">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                        </svg>
                        Appointments
                    </a>
                </li>
                <li>
                    <a href="{{ route('queues.index') }}" class="flex items-center p-3 rounded hover:bg-white hover:bg-opacity-20 ">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Queue
                    </a>
                </li>
                <li>
                    <a href="{{ route('opd.index') }}" class="flex items-center p-3 rounded hover:bg-white hover:bg-opacity-20 ">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        OPD
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded hover:bg-white hover:bg-opacity-20 ">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Edit Staff') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
            <div class="p-6">
                <form action="{{ route('staff.update', $staff) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium">Name</label>
                        <input type="text" name="name" id="name" value="{{ $staff->user->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" id="email" value="{{ $staff->user->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-medium">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ $staff->user->phone }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-medium">Address</label>
                        <textarea name="address" id="address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $staff->user->address }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="staff_type" class="block text-gray-700 font-medium">Staff Type</label>
                        <select name="staff_type" id="staff_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="nurse" {{ $staff->staff_type == 'nurse' ? 'selected' : '' }}>Nurse</option>
                            <option value="front_desk" {{ $staff->staff_type == 'front_desk' ? 'selected' : '' }}>Front Desk</option>
                            <option value="pharmacist" {{ $staff->staff_type == 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                            <option value="lab_tech" {{ $staff->staff_type == 'lab_tech' ? 'selected' : '' }}>Lab Tech</option>
                            <option value="it_admin" {{ $staff->staff_type == 'it_admin' ? 'selected' : '' }}>IT Admin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="department" class="block text-gray-700 font-medium">Department</label>
                        <input type="text" name="department" id="department" value="{{ $staff->department }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="mb-4">
                        <label for="hire_date" class="block text-gray-700 font-medium">Hire Date</label>
                        <input type="date" name="hire_date" id="hire_date" value="{{ $staff->hire_date }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="mb-4">
                        <label for="notes" class="block text-gray-700 font-medium">Notes</label>
                        <textarea name="notes" id="notes" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $staff->notes }}</textarea>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-2 px-4 rounded-lg ">Update Staff</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
