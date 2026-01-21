<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create OPD Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('opd.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="patient_search" class="block text-sm font-medium text-gray-700">Search Patient</label>
                            <input type="text" id="patient_search" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Search by name, email, or hospital ID">
                            <input type="hidden" name="patient_id" id="patient_id">
                            <div id="patient_results" class="mt-2"></div>
                        </div>

                        <div class="mb-4">
                            <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }} - {{ $doctor->specialization }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="fee_amount" class="block text-sm font-medium text-gray-700">Fee Amount</label>
                            <input type="number" name="fee_amount" id="fee_amount" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="visit_time" class="block text-sm font-medium text-gray-700">Visit Time (Optional)</label>
                            <input type="time" name="visit_time" id="visit_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create OPD Ticket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('patient_search').addEventListener('input', function() {
            const query = this.value;
            if (query.length > 2) {
                fetch(`{{ route('opd.search-patients') }}?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        const results = document.getElementById('patient_results');
                        results.innerHTML = '';
                        data.forEach(patient => {
                            const div = document.createElement('div');
                            div.className = 'cursor-pointer p-2 hover:bg-gray-100';
                            div.textContent = `${patient.user.name} (${patient.hospital_id})`;
                            div.onclick = () => {
                                document.getElementById('patient_id').value = patient.id;
                                document.getElementById('patient_search').value = `${patient.user.name} (${patient.hospital_id})`;
                                results.innerHTML = '';
                            };
                            results.appendChild(div);
                        });
                    });
            }
        });
    </script>
</x-app-layout>