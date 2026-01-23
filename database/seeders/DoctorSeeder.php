<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorRole = Role::where('name', 'Doctors')->first();

        $doctors = [
            [
                'name' => 'Dr. Sarah Johnson',
                'email' => 'sarah.johnson@hospital.com',
                'phone' => '+8801712345671',
                'address' => '123 Medical Center, Dhaka, Bangladesh',
                'specialization' => 'Cardiology',
                'bmdc_registration_number' => 'BMDC-12345',
                'qualifications' => 'MBBS, MD (Cardiology), FCCP\nAmerican Board Certified Cardiologist\nFellow of the American College of Cardiology',
                'experience_years' => 12,
                'bio' => 'Dr. Sarah Johnson is a renowned cardiologist with over 12 years of experience in cardiovascular medicine. She specializes in interventional cardiology and has performed over 500 successful cardiac procedures.',
            ],
            [
                'name' => 'Dr. Ahmed Rahman',
                'email' => 'ahmed.rahman@hospital.com',
                'phone' => '+8801712345672',
                'address' => '456 Healthcare Avenue, Dhaka, Bangladesh',
                'specialization' => 'Neurology',
                'bmdc_registration_number' => 'BMDC-12346',
                'qualifications' => 'MBBS, MD (Neurology), PhD\nBoard Certified Neurologist\nMember of Bangladesh Neurological Society',
                'experience_years' => 15,
                'bio' => 'Dr. Ahmed Rahman is a leading neurologist specializing in stroke management and neurodegenerative disorders. He has extensive experience in both clinical practice and neurological research.',
            ],
            [
                'name' => 'Dr. Maria Santos',
                'email' => 'maria.santos@hospital.com',
                'phone' => '+8801712345673',
                'address' => '789 Wellness Street, Dhaka, Bangladesh',
                'specialization' => 'Pediatrics',
                'bmdc_registration_number' => 'BMDC-12347',
                'qualifications' => 'MBBS, MD (Pediatrics), DCH\nFellow of the American Academy of Pediatrics\nCertified in Pediatric Advanced Life Support',
                'experience_years' => 10,
                'bio' => 'Dr. Maria Santos is a dedicated pediatrician with a passion for child healthcare. She provides comprehensive medical care for infants, children, and adolescents.',
            ],
            [
                'name' => 'Dr. David Chen',
                'email' => 'david.chen@hospital.com',
                'phone' => '+8801712345674',
                'address' => '321 Health Boulevard, Dhaka, Bangladesh',
                'specialization' => 'Orthopedics',
                'bmdc_registration_number' => 'BMDC-12348',
                'qualifications' => 'MBBS, MS (Orthopedics), DNB\nFellowship in Joint Replacement Surgery\nMember of Bangladesh Orthopaedic Society',
                'experience_years' => 14,
                'bio' => 'Dr. David Chen is an expert orthopedic surgeon specializing in joint replacement and sports medicine. He has successfully performed numerous complex orthopedic surgeries.',
            ],
            [
                'name' => 'Dr. Fatima Al-Zahra',
                'email' => 'fatima.alzahra@hospital.com',
                'phone' => '+8801712345675',
                'address' => '654 Medical Plaza, Dhaka, Bangladesh',
                'specialization' => 'Gynecology',
                'bmdc_registration_number' => 'BMDC-12349',
                'qualifications' => 'MBBS, MD (Obstetrics & Gynecology), DGO\nFellow of the Royal College of Obstetricians and Gynaecologists\nCertified Laparoscopic Surgeon',
                'experience_years' => 11,
                'bio' => 'Dr. Fatima Al-Zahra is a skilled gynecologist providing comprehensive women\'s healthcare services including prenatal care, gynecological surgeries, and family planning.',
            ],
            [
                'name' => 'Dr. Robert Kim',
                'email' => 'robert.kim@hospital.com',
                'phone' => '+8801712345676',
                'address' => '987 Healthcare Complex, Dhaka, Bangladesh',
                'specialization' => 'Dermatology',
                'bmdc_registration_number' => 'BMDC-12350',
                'qualifications' => 'MBBS, MD (Dermatology), DVD\nBoard Certified Dermatologist\nFellow of the International Society of Dermatology',
                'experience_years' => 9,
                'bio' => 'Dr. Robert Kim specializes in medical and cosmetic dermatology. He provides comprehensive skin care treatments including laser therapy, chemical peels, and skin cancer screening.',
            ],
            [
                'name' => 'Dr. Priya Patel',
                'email' => 'priya.patel@hospital.com',
                'phone' => '+8801712345677',
                'address' => '147 Wellness Center, Dhaka, Bangladesh',
                'specialization' => 'Ophthalmology',
                'bmdc_registration_number' => 'BMDC-12351',
                'qualifications' => 'MBBS, MS (Ophthalmology), DNB\nFellowship in Vitreo-Retinal Surgery\nMember of Bangladesh Ophthalmological Society',
                'experience_years' => 13,
                'bio' => 'Dr. Priya Patel is an experienced ophthalmologist specializing in retinal diseases and cataract surgery. She has performed thousands of successful eye surgeries.',
            ],
            [
                'name' => 'Dr. Michael Thompson',
                'email' => 'michael.thompson@hospital.com',
                'phone' => '+8801712345678',
                'address' => '258 Medical Tower, Dhaka, Bangladesh',
                'specialization' => 'Urology',
                'bmdc_registration_number' => 'BMDC-12352',
                'qualifications' => 'MBBS, MS (Urology), MCh\nFellowship in Laparoscopic Urology\nMember of Urological Society of Bangladesh',
                'experience_years' => 16,
                'bio' => 'Dr. Michael Thompson is a urologist with expertise in minimally invasive urological procedures. He specializes in kidney stone treatment and prostate disorders.',
            ],
            [
                'name' => 'Dr. Lisa Wong',
                'email' => 'lisa.wong@hospital.com',
                'phone' => '+8801712345679',
                'address' => '369 Health Avenue, Dhaka, Bangladesh',
                'specialization' => 'Psychiatry',
                'bmdc_registration_number' => 'BMDC-12353',
                'qualifications' => 'MBBS, MD (Psychiatry), DPM\nBoard Certified Psychiatrist\nCertified Cognitive Behavioral Therapist',
                'experience_years' => 8,
                'bio' => 'Dr. Lisa Wong provides comprehensive mental health care with a focus on evidence-based treatments. She specializes in anxiety disorders, depression, and psychotherapy.',
            ],
            [
                'name' => 'Dr. James Wilson',
                'email' => 'james.wilson@hospital.com',
                'phone' => '+8801712345680',
                'address' => '741 Medical Center, Dhaka, Bangladesh',
                'specialization' => 'General Surgery',
                'bmdc_registration_number' => 'BMDC-12354',
                'qualifications' => 'MBBS, MS (General Surgery), DNB\nFellowship in Laparoscopic Surgery\nMember of Association of Surgeons of Bangladesh',
                'experience_years' => 18,
                'bio' => 'Dr. James Wilson is a skilled general surgeon with extensive experience in laparoscopic and open surgical procedures. He has a reputation for excellent patient outcomes.',
            ],
        ];

        foreach ($doctors as $doctorData) {
            // Create user
            $user = User::create([
                'name' => $doctorData['name'],
                'email' => $doctorData['email'],
                'password' => Hash::make('password123'),
                'phone' => $doctorData['phone'],
                'address' => $doctorData['address'],
                'role_id' => $doctorRole->id,
            ]);

            // Attach doctor role to user_roles table
            $user->roles()->attach($doctorRole->id);

            // Create doctor record
            Doctor::create([
                'user_id' => $user->id,
                'specialization' => $doctorData['specialization'],
                'bmdc_registration_number' => $doctorData['bmdc_registration_number'],
                'qualifications' => $doctorData['qualifications'],
                'experience_years' => $doctorData['experience_years'],
                'bio' => $doctorData['bio'],
            ]);
        }
    }
}