@extends('layouts.dashboard')

@section('sidebar')
<!-- Sidebar -->
<div class="w-64 bg-gradient-to-b from-indigo-600 via-purple-600 to-pink-600 text-white min-h-screen shadow-xl">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Hospital HMS</h2>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-30' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                @if(auth()->user()->role && auth()->user()->role->name == 'Administrators')
                <li>
                    <a href="{{ route('doctors.index') }}" class="flex items-center p-3 rounded">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Doctors
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.index') }}" class="flex items-center p-3 rounded">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Staff
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('appointments.index') }}" class="flex items-center p-3 rounded">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                        </svg>
                        Appointments
                    </a>
                </li>
                <li>
                    <a href="{{ route('queues.index') }}" class="flex items-center p-3 rounded">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Queue
                    </a>
                </li>
                <li>
                    <a href="{{ route('opd.index') }}" class="flex items-center p-3 rounded">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        OPD
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded">
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
    {{ __('Dashboard') }}
</h2>
@endsection

@section('content')
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white">
                    <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h3>
                    <p class="text-blue-100">You are logged in as {{ auth()->user()->role ? auth()->user()->role->name : 'No Role' }}. Here's your overview.</p>
                </div>
            </div>

            @if(auth()->user()->role && auth()->user()->role->name == 'Administrators')
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Doctors</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Doctor::count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Staff</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Staff::count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-pink-500 to-red-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Patients</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Patient::count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Today's Appointments</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Appointment::whereDate('date', today())->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="{{ route('doctors.create') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-lg hover:from-blue-100 hover:to-purple-100 ">
                                <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Add Doctor</p>
                                    <p class="text-sm text-gray-600">Register a new doctor</p>
                                </div>
                            </a>
                            <a href="{{ route('staff.create') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg hover:from-purple-100 hover:to-pink-100 ">
                                <div class="p-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Add Staff</p>
                                    <p class="text-sm text-gray-600">Register new staff member</p>
                                </div>
                            </a>
                            <a href="{{ route('opd.create') }}" class="flex items-center p-4 bg-gradient-to-r from-pink-50 to-red-50 border border-pink-200 rounded-lg hover:from-pink-100 hover:to-red-100 ">
                                <div class="p-2 bg-gradient-to-r from-pink-500 to-red-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">New OPD Visit</p>
                                    <p class="text-sm text-gray-600">Start a new patient visit</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Management Sections -->
                <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <h4 class="font-semibold mb-4 text-gray-900">Management</h4>
                            <div class="space-y-2">
                                <a href="{{ route('doctors.index') }}" class="block p-3 bg-gradient-to-r from-blue-50 to-purple-50 rounded hover:from-blue-100 hover:to-purple-100 ">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Manage Doctors
                                    </div>
                                </a>
                                <a href="{{ route('staff.index') }}" class="block p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded hover:from-purple-100 hover:to-pink-100 ">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-purple-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Manage Staff
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="font-semibold mb-4 text-gray-900">Operations</h4>
                            <div class="space-y-2">
                                <a href="{{ route('appointments.index') }}" class="block p-3 bg-gradient-to-r from-pink-50 to-red-50 rounded hover:from-pink-100 hover:to-red-100 ">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                        </svg>
                                        Appointments
                                    </div>
                                </a>
                                <a href="{{ route('queues.index') }}" class="block p-3 bg-gradient-to-r from-red-50 to-orange-50 rounded hover:from-red-100 hover:to-orange-100 ">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        Queue Management
                                    </div>
                                </a>
                                <a href="{{ route('opd.index') }}" class="block p-3 bg-gradient-to-r from-orange-50 to-yellow-50 rounded hover:from-orange-100 hover:to-yellow-100 ">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-orange-800 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        OPD Visits
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->role && auth()->user()->role->name == 'Doctors')
                <!-- Doctor Dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Today's Appointments</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Appointment::where('doctor_id', auth()->user()->doctor?->id)->whereDate('date', today())->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Pending Queue</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Queue::where('status', 'waiting')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-pink-500 to-red-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Today's Visits</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Visit::where('doctor_id', auth()->user()->doctor?->id)->whereDate('visit_date', today())->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900">Doctor Panel</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="{{ route('appointments.index') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-lg hover:from-blue-100 hover:to-purple-100 ">
                                <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">View Appointments</p>
                                    <p class="text-sm text-gray-600">Check your schedule</p>
                                </div>
                            </a>
                            <a href="{{ route('queues.index') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg hover:from-purple-100 hover:to-pink-100 ">
                                <div class="p-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Manage Queue</p>
                                    <p class="text-sm text-gray-600">Handle patient queue</p>
                                </div>
                            </a>
                            <a href="{{ route('opd.index') }}" class="flex items-center p-4 bg-gradient-to-r from-pink-50 to-red-50 border border-pink-200 rounded-lg hover:from-pink-100 hover:to-red-100 ">
                                <div class="p-2 bg-gradient-to-r from-pink-500 to-red-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">OPD Visits</p>
                                    <p class="text-sm text-gray-600">Patient consultations</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->role && auth()->user()->role->name == 'Front Desk/Billing Staff')
                <!-- Front Desk Dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Today's Appointments</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Appointment::whereDate('date', today())->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Active Queue</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Queue::where('status', 'waiting')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-gradient-to-r from-pink-500 to-red-500 text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Today's Visits</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Visit::whereDate('visit_date', today())->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg ">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900">Front Desk Panel</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="{{ route('appointments.index') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-lg hover:from-blue-100 hover:to-purple-100 ">
                                <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Manage Appointments</p>
                                    <p class="text-sm text-gray-600">Schedule and manage appointments</p>
                                </div>
                            </a>
                            <a href="{{ route('queues.index') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg hover:from-purple-100 hover:to-pink-100 ">
                                <div class="p-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Manage Queue</p>
                                    <p class="text-sm text-gray-600">Handle patient queue</p>
                                </div>
                            </a>
                            <a href="{{ route('opd.index') }}" class="flex items-center p-4 bg-gradient-to-r from-pink-50 to-red-50 border border-pink-200 rounded-lg hover:from-pink-100 hover:to-red-100 ">
                                <div class="p-2 bg-gradient-to-r from-pink-500 to-red-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">OPD Management</p>
                                    <p class="text-sm text-gray-600">Manage outpatient visits</p>
                                </div>
                            </a>
                            <a href="{{ route('opd.create') }}" class="flex items-center p-4 bg-gradient-to-r from-red-50 to-orange-50 border border-red-200 rounded-lg hover:from-red-100 hover:to-orange-100 ">
                                <div class="p-2 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-full mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">New OPD Visit</p>
                                    <p class="text-sm text-gray-600">Start a new patient visit</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>{{ __("Your role-specific dashboard is under development.") }}</p>
                    </div>
                </div>
            @endif
@endsection
