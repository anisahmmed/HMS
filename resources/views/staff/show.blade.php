<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">{{ $staff->user->name }}</h3>
                    <p><strong>Email:</strong> {{ $staff->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $staff->user->phone }}</p>
                    <p><strong>Address:</strong> {{ $staff->user->address }}</p>
                    <p><strong>Staff Type:</strong> {{ ucfirst(str_replace('_', ' ', $staff->staff_type)) }}</p>
                    <p><strong>Department:</strong> {{ $staff->department }}</p>
                    <p><strong>Hire Date:</strong> {{ $staff->hire_date }}</p>
                    <p><strong>Notes:</strong> {{ $staff->notes }}</p>
                    <h4 class="text-md font-semibold mt-6 mb-2">Duty Roster</h4>
                    <!-- Placeholder for duty roster assignment -->
                    <p>Duty roster management can be added here.</p>
                    <a href="{{ route('staff.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
