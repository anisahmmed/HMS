<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientRole = Role::where('name', 'Patients')->first();

        $patients = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith.patient@email.com',
                'phone' => '+8801712345601',
                'address' => '123 Main Street, Dhaka, Bangladesh',
                'date_of_birth' => '1985-03-15',
                'gender' => 'Male',
                'emergency_contact' => '+8801712345602',
                'hospital_id' => 'P001',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson.patient@email.com',
                'phone' => '+8801712345603',
                'address' => '456 Oak Avenue, Dhaka, Bangladesh',
                'date_of_birth' => '1990-07-22',
                'gender' => 'Female',
                'emergency_contact' => '+8801712345604',
                'hospital_id' => 'P002',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown.patient@email.com',
                'phone' => '+8801712345605',
                'address' => '789 Pine Road, Dhaka, Bangladesh',
                'date_of_birth' => '1978-11-08',
                'gender' => 'Male',
                'emergency_contact' => '+8801712345606',
                'hospital_id' => 'P003',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis.patient@email.com',
                'phone' => '+8801712345607',
                'address' => '321 Elm Street, Dhaka, Bangladesh',
                'date_of_birth' => '1995-01-30',
                'gender' => 'Female',
                'emergency_contact' => '+8801712345608',
                'hospital_id' => 'P004',
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson.patient@email.com',
                'phone' => '+8801712345609',
                'address' => '654 Maple Drive, Dhaka, Bangladesh',
                'date_of_birth' => '1982-09-12',
                'gender' => 'Male',
                'emergency_contact' => '+8801712345610',
                'hospital_id' => 'P005',
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.anderson.patient@email.com',
                'phone' => '+8801712345611',
                'address' => '987 Cedar Lane, Dhaka, Bangladesh',
                'date_of_birth' => '1988-05-18',
                'gender' => 'Female',
                'emergency_contact' => '+8801712345612',
                'hospital_id' => 'P006',
            ],
            [
                'name' => 'Robert Taylor',
                'email' => 'robert.taylor.patient@email.com',
                'phone' => '+8801712345613',
                'address' => '147 Birch Boulevard, Dhaka, Bangladesh',
                'date_of_birth' => '1975-12-03',
                'gender' => 'Male',
                'emergency_contact' => '+8801712345614',
                'hospital_id' => 'P007',
            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.martinez.patient@email.com',
                'phone' => '+8801712345615',
                'address' => '258 Walnut Way, Dhaka, Bangladesh',
                'date_of_birth' => '1992-06-25',
                'gender' => 'Female',
                'emergency_contact' => '+8801712345616',
                'hospital_id' => 'P008',
            ],
        ];

        foreach ($patients as $patientData) {
            // Create user
            $user = User::create([
                'name' => $patientData['name'],
                'email' => $patientData['email'],
                'password' => Hash::make('password123'),
                'phone' => $patientData['phone'],
                'address' => $patientData['address'],
            ]);

            // Attach patient role to user_roles table
            $user->roles()->attach($patientRole->id);

            // Create patient record
            Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => $patientData['date_of_birth'],
                'gender' => strtolower($patientData['gender']),
                'emergency_contact' => $patientData['emergency_contact'],
                'hospital_id' => $patientData['hospital_id'],
                'address' => $patientData['address'],
            ]);
        }
    }
}