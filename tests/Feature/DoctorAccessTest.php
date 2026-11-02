<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_doctor_can_access_doctor_dashboard(): void
    {
        $doctorUser = User::factory()->create([
            'role' => 'doctor',
        ]);

        $specialty = Specialty::create([
            'name' => 'Test Specialty',
            'description' => 'Specialty for automated testing',
        ]);

        Doctor::create([
            'user_id' => $doctorUser->id,
            'name' => 'Test Doctor',
            'email' => $doctorUser->email,
            'specialty_id' => $specialty->id,
            'phone' => '01000000000',
            'bio' => 'Test doctor profile',
            'is_available' => true,
            'working_days' => ['Sunday', 'Monday'],
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);

        $response = $this->actingAs($doctorUser)
            ->get(route('doctor.dashboard'));

        $response->assertOk();
    }

    public function test_patient_cannot_access_doctor_dashboard(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        $response = $this->actingAs($patient)
            ->get(route('doctor.dashboard'));

        $response->assertForbidden();
    }

    public function test_admin_cannot_access_doctor_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->get(route('doctor.dashboard'));

        $response->assertForbidden();
    }

    public function test_doctor_without_profile_cannot_access_dashboard(): void
    {
        $doctorUser = User::factory()->create([
            'role' => 'doctor',
        ]);

        $response = $this->actingAs($doctorUser)
            ->get(route('doctor.dashboard'));

        $response->assertForbidden();
    }
}

