<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->get(route('admin.dashboard'));

        $response->assertOk();
    }

    public function test_patient_cannot_access_admin_dashboard(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        $response = $this->actingAs($patient)
            ->get(route('admin.dashboard'));

        $response->assertForbidden();
    }

    public function test_doctor_cannot_access_admin_dashboard(): void
    {
        $doctor = User::factory()->create([
            'role' => 'doctor',
        ]);

        $response = $this->actingAs($doctor)
            ->get(route('admin.dashboard'));

        $response->assertForbidden();
    }
}

