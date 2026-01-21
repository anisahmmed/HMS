<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Doctors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('doctors.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Add New Doctor
                    </a>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Name</th>
                                <th class="py-2 px-4 border-b">Email</th>
                                <th class="py-2 px-4 border-b">Specialization</th>
                                <th class="py-2 px-4 border-b">BMDC Number</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $doctor->user->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $doctor->user->email }}</td>
                                <td class="py-2 px-4 border-b">{{ $doctor->specialization }}</td>
                                <td class="py-2 px-4 border-b">{{ $doctor->bmdc_registration_number }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('doctors.show', $doctor) }}" class="text-blue-500">View</a>
                                    <a href="{{ route('doctors.edit', $doctor) }}" class="text-green-500 ml-2">Edit</a>
                                    <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
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