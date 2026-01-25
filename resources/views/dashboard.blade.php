@extends('layouts.dashboard')

@section('sidebar')
<!-- Sidebar -->
<div class="bg-gradient-to-b from-indigo-600 via-purple-600 to-pink-600 text-white min-h-screen shadow-xl">
    <div :class="sidebarOpen ? 'p-6' : 'p-2'">
        <h2 :class="sidebarOpen ? 'text-2xl' : 'text-sm'" class="font-bold mb-6">Hospital HMS</h2>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-30' : '' }}">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Dashboard</span>
                    </a>
                </li>
                @if(auth()->user()->role && auth()->user()->role->name == 'Administrators')
                <li>
                    <a href="{{ route('doctors.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Doctors</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Staff</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('appointments.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                        </svg>
                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('queues.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Queue</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('opd.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">OPD</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded group transition-colors duration-300">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Profile</span>
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
            <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl mb-8 border border-white/20 hover:shadow-3xl transition-all duration-500 transform hover:scale-[1.02]">
                <div class="p-8 bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-600 text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-black/10"></div>
                    <div class="relative z-10 flex items-center">
                        <div class="p-4 bg-white/20 rounded-2xl mr-6 backdrop-blur-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold mb-3 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Welcome back, {{ auth()->user()->name }}!</h3>
                            <p class="text-blue-100 text-lg">You are logged in as {{ auth()->user()->role ? auth()->user()->role->name : 'No Role' }}. Here's your overview.</p>
                        </div>
                    </div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-purple-300/20 rounded-full blur-xl"></div>
                </div>
            </div>

            @if(auth()->user()->role && auth()->user()->role->name == 'Administrators')
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                    <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl border border-white/20 hover:shadow-3xl hover:shadow-blue-500/10 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 group">
                        <div class="p-8 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-purple-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10 flex items-center">
                                <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 text-white shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Doctors</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ \App\Models\Doctor::count() }}</p>
                                </div>
                            </div>
                            <div class="absolute -top-6 -right-6 w-20 h-20 bg-blue-400/10 rounded-full blur-2xl group-hover:bg-blue-400/20 transition-all duration-500"></div>
                        </div>
                    </div>
                    <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl border border-white/20 hover:shadow-3xl hover:shadow-purple-500/10 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 group">
                        <div class="p-8 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-pink-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10 flex items-center">
                                <div class="p-4 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 text-white shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Staff</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ \App\Models\Staff::count() }}</p>
                                </div>
                            </div>
                            <div class="absolute -top-6 -right-6 w-20 h-20 bg-purple-400/10 rounded-full blur-2xl group-hover:bg-purple-400/20 transition-all duration-500"></div>
                        </div>
                    </div>
                    <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl border border-white/20 hover:shadow-3xl hover:shadow-pink-500/10 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 group">
                        <div class="p-8 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-pink-50/50 to-red-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10 flex items-center">
                                <div class="p-4 rounded-2xl bg-gradient-to-br from-pink-500 to-red-600 text-white shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Patients</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ \App\Models\Patient::count() }}</p>
                                </div>
                            </div>
                            <div class="absolute -top-6 -right-6 w-20 h-20 bg-pink-400/10 rounded-full blur-2xl group-hover:bg-pink-400/20 transition-all duration-500"></div>
                        </div>
                    </div>
                    <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl border border-white/20 hover:shadow-3xl hover:shadow-indigo-500/10 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 group">
                        <div class="p-8 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 to-blue-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10 flex items-center">
                                <div class="p-4 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Today's Appointments</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ \App\Models\Appointment::whereDate('date', today())->count() }}</p>
                                </div>
                            </div>
                            <div class="absolute -top-6 -right-6 w-20 h-20 bg-indigo-400/10 rounded-full blur-2xl group-hover:bg-indigo-400/20 transition-all duration-500"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl border border-white/20">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-8 text-gray-900 bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <a href="{{ route('doctors.create') }}" class="group flex items-center p-6 bg-gradient-to-br from-blue-50 via-purple-50 to-indigo-50 border border-blue-200/50 rounded-2xl hover:from-blue-100 hover:via-purple-100 hover:to-indigo-100 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/5 to-purple-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="p-4 bg-gradient-to-br from-blue-500 to-purple-600 text-white rounded-2xl mr-5 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12 relative z-10">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div class="relative z-10">
                                    <p class="font-bold text-gray-900 text-lg">Add Doctor</p>
                                    <p class="text-sm text-gray-600 mt-1">Register a new doctor</p>
                                </div>
                                <div class="absolute -top-4 -right-4 w-16 h-16 bg-blue-400/10 rounded-full blur-xl group-hover:bg-blue-400/20 transition-all duration-500"></div>
                            </a>
                            <a href="{{ route('staff.create') }}" class="group flex items-center p-6 bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 border border-purple-200/50 rounded-2xl hover:from-purple-100 hover:via-pink-100 hover:to-rose-100 hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/5 to-pink-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="p-4 bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-2xl mr-5 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12 relative z-10">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div class="relative z-10">
                                    <p class="font-bold text-gray-900 text-lg">Add Staff</p>
                                    <p class="text-sm text-gray-600 mt-1">Register new staff member</p>
                                </div>
                                <div class="absolute -top-4 -right-4 w-16 h-16 bg-purple-400/10 rounded-full blur-xl group-hover:bg-purple-400/20 transition-all duration-500"></div>
                            </a>
                            <a href="{{ route('appointments.create') }}" class="group flex items-center p-6 bg-gradient-to-br from-indigo-50 via-blue-50 to-cyan-50 border border-indigo-200/50 rounded-2xl hover:from-indigo-100 hover:via-blue-100 hover:to-cyan-100 hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-indigo-400/5 to-blue-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="p-4 bg-gradient-to-br from-indigo-500 to-blue-600 text-white rounded-2xl mr-5 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12 relative z-10">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div class="relative z-10">
                                    <p class="font-bold text-gray-900 text-lg">Schedule Appointment</p>
                                    <p class="text-sm text-gray-600 mt-1">Book a new appointment</p>
                                </div>
                                <div class="absolute -top-4 -right-4 w-16 h-16 bg-indigo-400/10 rounded-full blur-xl group-hover:bg-indigo-400/20 transition-all duration-500"></div>
                            </a>
                            <a href="{{ route('opd.create') }}" class="group flex items-center p-6 bg-gradient-to-br from-pink-50 via-red-50 to-orange-50 border border-pink-200/50 rounded-2xl hover:from-pink-100 hover:via-red-100 hover:to-orange-100 hover:shadow-2xl hover:shadow-pink-500/20 transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-pink-400/5 to-red-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="p-4 bg-gradient-to-br from-pink-500 to-red-600 text-white rounded-2xl mr-5 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-12 relative z-10">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="relative z-10">
                                    <p class="font-bold text-gray-900 text-lg">New OPD Visit</p>
                                    <p class="text-sm text-gray-600 mt-1">Start a new patient visit</p>
                                </div>
                                <div class="absolute -top-4 -right-4 w-16 h-16 bg-pink-400/10 rounded-full blur-xl group-hover:bg-pink-400/20 transition-all duration-500"></div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Management Sections -->
                <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl border border-white/20">
                        <div class="p-8">
                            <h4 class="text-2xl font-bold mb-6 text-gray-900 bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">Management</h4>
                            <div class="space-y-4">
                                <a href="{{ route('doctors.index') }}" class="group block p-5 bg-gradient-to-r from-blue-50 via-purple-50 to-indigo-50 rounded-2xl hover:from-blue-100 hover:via-purple-100 hover:to-indigo-100 hover:shadow-xl hover:shadow-blue-500/20 transition-all duration-500 transform hover:scale-102 hover:-translate-y-1 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 to-purple-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="flex items-center relative z-10">
                                        <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 text-white rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-6">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-gray-900 text-lg">Manage Doctors</span>
                                    </div>
                                </a>
                                <a href="{{ route('staff.index') }}" class="group block p-5 bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50 rounded-2xl hover:from-purple-100 hover:via-pink-100 hover:to-rose-100 hover:shadow-xl hover:shadow-purple-500/20 transition-all duration-500 transform hover:scale-102 hover:-translate-y-1 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-purple-400/5 to-pink-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="flex items-center relative z-10">
                                        <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-6">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-gray-900 text-lg">Manage Staff</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/90 backdrop-blur-lg overflow-hidden shadow-2xl sm:rounded-2xl border border-white/20">
                        <div class="p-8">
                            <h4 class="text-2xl font-bold mb-6 text-gray-900 bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">Operations</h4>
                            <div class="space-y-4">
                                <a href="{{ route('appointments.index') }}" class="group block p-5 bg-gradient-to-r from-pink-50 via-red-50 to-orange-50 rounded-2xl hover:from-pink-100 hover:via-red-100 hover:to-orange-100 hover:shadow-xl hover:shadow-pink-500/20 transition-all duration-500 transform hover:scale-102 hover:-translate-y-1 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-pink-400/5 to-red-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="flex items-center relative z-10">
                                        <div class="p-3 bg-gradient-to-br from-pink-500 to-red-600 text-white rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-6">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-gray-900 text-lg">Appointments</span>
                                    </div>
                                </a>
                                <a href="{{ route('queues.index') }}" class="group block p-5 bg-gradient-to-r from-red-50 via-orange-50 to-yellow-50 rounded-2xl hover:from-red-100 hover:via-orange-100 hover:to-yellow-100 hover:shadow-xl hover:shadow-red-500/20 transition-all duration-500 transform hover:scale-102 hover:-translate-y-1 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-red-400/5 to-orange-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="flex items-center relative z-10">
                                        <div class="p-3 bg-gradient-to-br from-red-500 to-orange-600 text-white rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-6">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-gray-900 text-lg">Queue Management</span>
                                    </div>
                                </a>
                                <a href="{{ route('opd.index') }}" class="group block p-5 bg-gradient-to-r from-orange-50 via-yellow-50 to-amber-50 rounded-2xl hover:from-orange-100 hover:via-yellow-100 hover:to-amber-100 hover:shadow-xl hover:shadow-orange-500/20 transition-all duration-500 transform hover:scale-102 hover:-translate-y-1 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-orange-400/5 to-yellow-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="flex items-center relative z-10">
                                        <div class="p-3 bg-gradient-to-br from-orange-500 to-yellow-600 text-white rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-all duration-500 transform group-hover:rotate-6">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-gray-900 text-lg">OPD Visits</span>
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
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <a href="{{ route('appointments.create') }}" class="flex items-center p-4 bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-200 rounded-lg hover:from-indigo-100 hover:to-blue-100 ">
                                <div class="p-2 bg-gradient-to-r from-indigo-500 to-blue-500 text-white rounded-full mr-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Schedule Appointment</p>
                                    <p class="text-sm text-gray-600">Book a new appointment</p>
                                </div>
                            </a>
                            <a href="{{ route('appointments.index') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-lg hover:from-blue-100 hover:to-purple-100 ">
                                <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full mr-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Manage Appointments</p>
                                    <p class="text-sm text-gray-600">View and manage appointments</p>
                                </div>
                            </a>
                            <a href="{{ route('queues.index') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg hover:from-purple-100 hover:to-pink-100 ">
                                <div class="p-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full mr-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
