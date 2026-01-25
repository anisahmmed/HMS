<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
        <div class="min-h-screen" x-data="{ sidebarOpen: true }">
            <!-- Fixed Top Navigation -->
            <div class="fixed top-0 left-0 right-0 z-40">
                @include('layouts.navigation')
            </div>

            <!-- Fixed Sidebar -->
            <div :class="sidebarOpen ? 'w-64' : 'w-16'" class="fixed left-0 top-16 bottom-0 transition-all duration-500 ease-in-out z-30">
                <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white h-full shadow-2xl overflow-y-auto backdrop-blur-sm border-r border-white/10">
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
                                    <a href="{{ route('doctors.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('doctors.*') ? 'bg-white bg-opacity-30' : '' }}">
                                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Doctors</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('staff.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('staff.*') ? 'bg-white bg-opacity-30' : '' }}">
                                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Staff</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('patients.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('patients.*') ? 'bg-white bg-opacity-30' : '' }}">
                                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Patients</span>
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ route('appointments.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('appointments.*') ? 'bg-white bg-opacity-30' : '' }}">
                                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                        </svg>
                                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Appointments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('queues.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('queues.*') ? 'bg-white bg-opacity-30' : '' }}">
                                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Queue</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('opd.index') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('opd.*') ? 'bg-white bg-opacity-30' : '' }}">
                                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">OPD</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded group transition-colors duration-300 {{ request()->routeIs('profile.*') ? 'bg-white bg-opacity-30' : '' }}">
                                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span :class="sidebarOpen ? '' : 'absolute left-full ml-2 bg-black text-white px-2 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300'" class="ml-3">Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Collapse Button inside sidebar -->
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2">
                        <button @click="sidebarOpen = !sidebarOpen" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 rounded-full shadow-lg focus:outline-none transition-all duration-300 backdrop-blur-sm">
                            <svg :class="sidebarOpen ? 'rotate-180' : 'rotate-0'" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div :class="sidebarOpen ? 'ml-64' : 'ml-16'" class="transition-all duration-500 ease-in-out pt-16 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
                <!-- Page Heading -->
                @hasSection('header')
                    <header class="bg-white/80 backdrop-blur-lg shadow-xl border-b border-white/20">
                        <div class="py-8 px-4 sm:px-6 lg:px-8">
                            @yield('header')
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="py-12 px-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
