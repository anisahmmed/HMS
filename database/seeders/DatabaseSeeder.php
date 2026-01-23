<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(PatientSeeder::class);

        // User::factory(10)->create();

        // Create admin user
        $adminRole = \App\Models\Role::where('name', 'Administrators')->first();
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id,
        ])->roles()->attach($adminRole->id);
    }
}
