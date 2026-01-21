<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">{{ $doctor->user->name }}</h3>
                    <p><strong>Email:</strong> {{ $doctor->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $doctor->user->phone }}</p>
                    <p><strong>Address:</strong> {{ $doctor->user->address }}</p>
                    <p><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
                    <p><strong>BMDC Registration Number:</strong> {{ $doctor->bmdc_registration_number }}</p>
                    <p><strong>Qualifications:</strong> {{ $doctor->qualifications }}</p>
                    <p><strong>Experience Years:</strong> {{ $doctor->experience_years }}</p>
                    <p><strong>Bio:</strong> {{ $doctor->bio }}</p>
                    <a href="{{ route('doctors.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>