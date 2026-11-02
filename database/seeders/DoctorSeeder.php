<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr. Ahmed Mohamed',
                'specialty_id' => 1,
                'phone' => '01012345678',
                'email' => 'ahmed@example.com',
                'bio' => 'Cardiology Specialist',
            ],
            [
                'name' => 'Dr. Sara Ali',
                'specialty_id' => 2,
                'phone' => '01098765432',
                'email' => 'sara@example.com',
                'bio' => 'Dermatology Specialist',
            ],
            [
                'name' => 'Dr. Omar Hassan',
                'specialty_id' => 3,
                'phone' => '01112345678',
                'email' => 'omar@example.com',
                'bio' => 'Pediatrics Specialist',
            ],
            [
                'name' => 'Dr. Nour Adel',
                'specialty_id' => 4,
                'phone' => '01198765432',
                'email' => 'nour@example.com',
                'bio' => 'Dentistry Specialist',
            ],
            [
                'name' => 'Dr. Youssef Samir',
                'specialty_id' => 5,
                'phone' => '01212345678',
                'email' => 'youssef@example.com',
                'bio' => 'Orthopedics Specialist',
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}