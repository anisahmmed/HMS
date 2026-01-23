@extends('layouts.dashboard')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
    </svg>
    {{ __('Appointment Details') }}
</h2>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Appointment Details</h1>
                    <p class="mt-2 text-gray-600">View complete appointment information</p>
                </div>
                <div class="flex items-center space-x-3">
                    @if(Auth::user()->hasRole('Front Desk/Billing Staff') || Auth::user()->hasRole('Administrators'))
                        <a href="{{ route('appointments.edit', $appointment) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Appointment
                        </a>
                    @endif
                    <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Appointments
                    </a>
                </div>
            </div>
        </div>

        <!-- Appointment Status Card -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r
                @if($appointment->status == 'scheduled') from-yellow-50 to-amber-50
                @elseif($appointment->status == 'confirmed') from-green-50 to-emerald-50
                @elseif($appointment->status == 'cancelled') from-red-50 to-rose-50
                @elseif($appointment->status == 'completed') from-blue-50 to-indigo-50
                @else from-gray-50 to-slate-50 @endif">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Appointment #{{ $appointment->id }}</h2>
                        <p class="mt-1 text-gray-600">Scheduled for {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }} at {{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}</p>
                    </div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                        @if($appointment->status == 'scheduled') bg-yellow-100 text-yellow-800
                        @elseif($appointment->status == 'confirmed') bg-green-100 text-green-800
                        @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                        @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($appointment->status == 'scheduled')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            @elseif($appointment->status == 'confirmed')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            @elseif($appointment->status == 'cancelled')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            @elseif($appointment->status == 'completed')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            @endif
                        </svg>
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Information Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Patient Information -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Patient Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 h-12 w-12">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                <span class="text-lg font-medium text-white">{{ substr($appointment->patient->user->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $appointment->patient->user->name }}</h4>
                            <p class="text-gray-600">{{ $appointment->patient->user->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @if($appointment->patient->user->phone)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-900">{{ $appointment->patient->user->phone }}</span>
                        </div>
                        @endif

                        @if($appointment->patient->user->address)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-900">{{ $appointment->patient->user->address }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Doctor Information -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Doctor Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 h-12 w-12">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                                <span class="text-lg font-medium text-white">{{ substr($appointment->doctor->user->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $appointment->doctor->user->name }}</h4>
                            <p class="text-gray-600">{{ $appointment->doctor->specialization }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-900">{{ $appointment->doctor->user->email }}</span>
                        </div>

                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-gray-900">{{ $appointment->doctor->bmdc_registration_number }}</span>
                        </div>

                        @if($appointment->doctor->experience_years)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-900">{{ $appointment->doctor->experience_years }} years experience</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Appointment Details
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Appointment Date</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Appointment Time</h4>
                        <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Status</h4>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($appointment->status == 'scheduled') bg-yellow-100 text-yellow-800
                            @elseif($appointment->status == 'confirmed') bg-green-100 text-green-800
                            @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                            @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Created</h4>
                        <p class="text-sm text-gray-900">{{ $appointment->created_at->format('M j, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                @if($appointment->notes)
                <div class="mt-6">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Notes</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-900 whitespace-pre-line">{{ $appointment->notes }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection