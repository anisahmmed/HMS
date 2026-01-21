<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Staff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('staff.update', $staff) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ $staff->user->name }}" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ $staff->user->email }}" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ $staff->user->phone }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-gray-700">Address</label>
                            <textarea name="address" id="address" class="w-full px-3 py-2 border rounded">{{ $staff->user->address }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="staff_type" class="block text-gray-700">Staff Type</label>
                            <select name="staff_type" id="staff_type" class="w-full px-3 py-2 border rounded" required>
                                <option value="nurse" {{ $staff->staff_type == 'nurse' ? 'selected' : '' }}>Nurse</option>
                                <option value="front_desk" {{ $staff->staff_type == 'front_desk' ? 'selected' : '' }}>Front Desk</option>
                                <option value="pharmacist" {{ $staff->staff_type == 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                                <option value="lab_tech" {{ $staff->staff_type == 'lab_tech' ? 'selected' : '' }}>Lab Tech</option>
                                <option value="it_admin" {{ $staff->staff_type == 'it_admin' ? 'selected' : '' }}>IT Admin</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="department" class="block text-gray-700">Department</label>
                            <input type="text" name="department" id="department" value="{{ $staff->department }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="hire_date" class="block text-gray-700">Hire Date</label>
                            <input type="date" name="hire_date" id="hire_date" value="{{ $staff->hire_date }}" class="w-full px-3 py-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="notes" class="block text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" class="w-full px-3 py-2 border rounded">{{ $staff->notes }}</textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Staff</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>