@extends('layouts.dashboard')

@section('sidebar')
<!-- Sidebar -->
<div class="w-64 bg-gradient-to-b from-indigo-600 via-purple-600 to-pink-600 text-white min-h-screen shadow-xl">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Hospital HMS</h2>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded">
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
                    <a href="{{ route('appointments.index') }}" class="flex items-center p-3 rounded bg-white bg-opacity-30">
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
    {{ __('Schedule Appointment') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-6">
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="patient_id" class="block text-gray-700 font-medium">Patient</label>
                        <select name="patient_id" id="patient_id" class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->user->name }} ({{ $patient->hospital_id }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="doctor_id" class="block text-gray-700 font-medium">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->user->name }} - {{ $doctor->specialization }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-medium">Date</label>
                        <input id="date" class="block mt-1 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" type="date" name="date" :value="old('date')" required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="time" class="block text-gray-700 font-medium">Time</label>
                        <input id="time" class="block mt-1 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" type="time" name="time" :value="old('time')" required />
                        <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="block text-gray-700 font-medium">Notes</label>
                        <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-500 text-white font-bold py-2 px-4 rounded-lg">
                            {{ __('Schedule Appointment') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
