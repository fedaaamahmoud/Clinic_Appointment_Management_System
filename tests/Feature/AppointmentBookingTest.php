<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentBookingTest extends TestCase
{
    use RefreshDatabase;

    private function createDoctor(): array
    {
        $specialty = Specialty::create([
            'name' => 'Test Specialty',
            'description' => 'Testing specialty',
        ]);

        $doctorUser = User::factory()->create([
            'role' => 'doctor',
        ]);

        $doctor = Doctor::create([
            'user_id' => $doctorUser->id,
            'name' => 'Test Doctor',
            'specialty_id' => $specialty->id,
            'email' => $doctorUser->email,
            'is_available' => true,
            'working_days' => ['Monday', 'Tuesday', 'Wednesday'],
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
        ]);

        return [$specialty, $doctor];
    }

    public function test_patient_can_book_valid_appointment(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        [$specialty, $doctor] = $this->createDoctor();

        $response = $this->actingAs($patient)->post(route('appointments.store'), [
            'specialty_id' => $specialty->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => '2027-11-01',
            'appointment_time' => '09:00',
            'notes' => 'Test appointment',
        ]);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('appointments', [
            'user_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => '2027-11-01',
            'appointment_time' => '09:00',
            'status' => 'pending',
        ]);
    }

    public function test_patient_cannot_book_on_doctor_non_working_day(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        [$specialty, $doctor] = $this->createDoctor();

        $response = $this->actingAs($patient)->from('/appointments/create')
            ->post(route('appointments.store'), [
                'specialty_id' => $specialty->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => '2027-11-04',
                'appointment_time' => '09:00',
            ]);

        $response->assertSessionHasErrors('appointment_date');

        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_patient_cannot_book_outside_working_hours(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        [$specialty, $doctor] = $this->createDoctor();

        $response = $this->actingAs($patient)->from('/appointments/create')
            ->post(route('appointments.store'), [
                'specialty_id' => $specialty->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => '2027-11-01',
                'appointment_time' => '17:00',
            ]);

        $response->assertSessionHasErrors('appointment_time');

        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_patient_cannot_book_invalid_time_slot(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        [$specialty, $doctor] = $this->createDoctor();

        $response = $this->actingAs($patient)->from('/appointments/create')
            ->post(route('appointments.store'), [
                'specialty_id' => $specialty->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => '2027-11-01',
                'appointment_time' => '09:15',
            ]);

        $response->assertSessionHasErrors('appointment_time');

        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_patient_cannot_book_already_reserved_slot(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        [$specialty, $doctor] = $this->createDoctor();

        Appointment::create([
            'user_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => '2027-11-01',
            'appointment_time' => '09:00',
            'status' => 'confirmed',
        ]);

        $response = $this->actingAs($patient)->from('/appointments/create')
            ->post(route('appointments.store'), [
                'specialty_id' => $specialty->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => '2027-11-01',
                'appointment_time' => '09:00',
            ]);

        $response->assertSessionHasErrors('appointment_time');

        $this->assertDatabaseCount('appointments', 1);
    }

    public function test_patient_cannot_book_unavailable_doctor(): void
    {
        $patient = User::factory()->create([
            'role' => 'patient',
        ]);

        [$specialty, $doctor] = $this->createDoctor();

        $doctor->update([
            'is_available' => false,
        ]);

        $response = $this->actingAs($patient)->from('/appointments/create')
            ->post(route('appointments.store'), [
                'specialty_id' => $specialty->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => '2027-11-01',
                'appointment_time' => '09:00',
            ]);

        $response->assertSessionHasErrors('doctor_id');

        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_guest_cannot_book_appointment(): void
    {
        [$specialty, $doctor] = $this->createDoctor();

        $response = $this->post(route('appointments.store'), [
            'specialty_id' => $specialty->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => '2027-11-01',
            'appointment_time' => '09:00',
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseCount('appointments', 0);
    }
}

