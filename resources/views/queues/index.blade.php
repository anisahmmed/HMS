<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Queue Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(Auth::user()->hasRole('Front Desk/Billing Staff'))
                        <a href="{{ route('queues.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                            Issue New Token
                        </a>
                    @endif

                    @if(Auth::user()->hasRole('Doctor'))
                        <form method="POST" action="{{ route('queues.call-next') }}" class="mb-4 inline-block">
                            @csrf
                            <input type="hidden" name="doctor_id" value="{{ Auth::user()->doctor->id }}">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Call Next Patient
                            </button>
                        </form>
                    @endif

                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Token Number</th>
                                <th class="py-2 px-4 border-b">Patient</th>
                                <th class="py-2 px-4 border-b">Doctor</th>
                                <th class="py-2 px-4 border-b">Status</th>
                                <th class="py-2 px-4 border-b">Issued Time</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($queues as $queue)
                            <tr>
                                <td class="py-2 px-4 border-b font-bold">{{ $queue->token_number }}</td>
                                <td class="py-2 px-4 border-b">{{ $queue->patient->user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $queue->doctor->user->name }}</td>
                                <td class="py-2 px-4 border-b">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($queue->status == 'waiting') bg-yellow-100 text-yellow-800
                                        @elseif($queue->status == 'called') bg-blue-100 text-blue-800
                                        @elseif($queue->status == 'served') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($queue->status) }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b">{{ $queue->issued_time->format('H:i') }}</td>
                                <td class="py-2 px-4 border-b">
                                    @if(Auth::user()->hasRole('Doctor') && $queue->status == 'called')
                                        <form method="POST" action="{{ route('queues.serve', $queue) }}" class="inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="text-green-600 hover:text-green-900">Serve</button>
                                        </form>
                                        |
                                        <form method="POST" action="{{ route('queues.cancel', $queue) }}" class="inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Cancel</button>
                                        </form>
                                    @else
                                        <a href="{{ route('queues.show', $queue) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>