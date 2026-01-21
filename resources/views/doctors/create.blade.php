<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Doctor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('doctors.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-gray-700">Address</label>
                            <textarea name="address" id="address" class="w-full px-3 py-2 border rounded"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="specialization" class="block text-gray-700">Specialization</label>
                            <input type="text" name="specialization" id="specialization" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="bmdc_registration_number" class="block text-gray-700">BMDC Registration Number</label>
                            <input type="text" name="bmdc_registration_number" id="bmdc_registration_number" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="qualifications" class="block text-gray-700">Qualifications</label>
                            <textarea name="qualifications" id="qualifications" class="w-full px-3 py-2 border rounded" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="experience_years" class="block text-gray-700">Experience Years</label>
                            <input type="number" name="experience_years" id="experience_years" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="bio" class="block text-gray-700">Bio</label>
                            <textarea name="bio" id="bio" class="w-full px-3 py-2 border rounded"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Doctor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>