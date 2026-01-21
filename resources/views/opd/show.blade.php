<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('OPD Visit History for ') . $patient->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Patient Information</h3>
                        <p><strong>Name:</strong> {{ $patient->user->name }}</p>
                        <p><strong>Hospital ID:</strong> {{ $patient->hospital_id }}</p>
                        <p><strong>Email:</strong> {{ $patient->user->email }}</p>
                        <p><strong>Date of Birth:</strong> {{ $patient->date_of_birth->format('d/m/Y') }}</p>
                        <p><strong>Gender:</strong> {{ ucfirst($patient->gender) }}</p>
                        <p><strong>Address:</strong> {{ $patient->address }}</p>
                        <p><strong>Emergency Contact:</strong> {{ $patient->emergency_contact }}</p>
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 mb-4">OPD Visit History</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visit Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($visitHistory as $visit)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visit->visit_date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visit->visit_time ? $visit->visit_time->format('H:i') : 'Not set' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visit->doctor->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $visit->ticket_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($visit->fee_amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $visit->fee_paid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $visit->fee_paid ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($visit->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($visitHistory->isEmpty())
                        <p class="mt-4 text-gray-500">No OPD visit history found for this patient.</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('opd.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to OPD List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>