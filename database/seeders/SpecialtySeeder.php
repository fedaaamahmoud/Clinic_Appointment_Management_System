<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Cardiology',
                'description' => 'Heart and blood vessel specialists',
            ],
            [
                'name' => 'Dermatology',
                'description' => 'Skin, hair and nail specialists',
            ],
            [
                'name' => 'Pediatrics',
                'description' => 'Medical care for children',
            ],
            [
                'name' => 'Dentistry',
                'description' => 'Teeth and oral health specialists',
            ],
            [
                'name' => 'Orthopedics',
                'description' => 'Bone, joint and muscle specialists',
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
