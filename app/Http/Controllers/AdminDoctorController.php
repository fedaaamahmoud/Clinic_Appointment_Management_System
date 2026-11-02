<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;

class AdminDoctorController extends Controller
{
    // Display all doctors
    public function index()
    {
        $doctors = Doctor::with('specialty')
            ->latest()
            ->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    // Show create doctor form
    public function create()
    {
        $specialties = Specialty::all();

        return view('admin.doctors.create', compact('specialties'));
    }

    // Store new doctor and create login account
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty_id' => 'required|exists:specialties,id',
            'email' => 'required|email|max:255|unique:users,email|unique:doctors,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',

            'working_days' => 'required|array|min:1',
            'working_days.*' => 'required|in:Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday',

            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        DB::transaction(function () use ($validated) {

            // Create doctor login account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'doctor',
            ]);

            // Create doctor profile and link it to the account
            Doctor::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'specialty_id' => $validated['specialty_id'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'working_days' => $validated['working_days'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
        });

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', 'Doctor and login account created successfully!');
    }

    // Show edit doctor form
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $specialties = Specialty::all();

        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    // Update doctor information
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty_id' => 'required|exists:specialties,id',
            'email' => 'nullable|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',

            'working_days' => 'required|array|min:1',
            'working_days.*' => 'required|in:Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday',

            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $doctor->update($validated);

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully!');
    }

    // Delete doctor
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($doctor->appointments()->exists()) {
            return redirect()
                ->route('admin.doctors.index')
                ->with('error', 'Cannot delete this doctor because they have appointments.');
        }

        DB::transaction(function () use ($doctor) {
            $user = $doctor->user;

            $doctor->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', 'Doctor and login account deleted successfully!');
    }

    // Toggle doctor availability
    public function toggleAvailability($id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->update([
            'is_available' => !$doctor->is_available,
        ]);

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', 'Doctor availability updated successfully!');
    }
}