<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Show booking page
    public function create()
    {
        $specialties = Specialty::with([
            'doctors' => function ($query) {
                $query->where('is_available', true);
            }
        ])
        ->whereHas('doctors', function ($query) {
            $query->where('is_available', true);
        })
        ->get();

        return view('appointments.create', compact('specialties'));
    }

    // Show patient's appointments
    public function index()
    {
    $appointments = Appointment::with([
        'doctor.specialty',
        'review',
    ])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('appointments.index', compact('appointments'));
   }

    // Store a new appointment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($validated) {

            // Lock doctor record during booking
            $doctor = Doctor::whereKey($validated['doctor_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // Check doctor availability
            if (!$doctor->is_available) {
                throw ValidationException::withMessages([
                    'doctor_id' => 'This doctor is not available.',
                ]);
            }

            // Check specialty
            if ($doctor->specialty_id != $validated['specialty_id']) {
                throw ValidationException::withMessages([
                    'doctor_id' => 'The selected doctor does not belong to this specialty.',
                ]);
            }

            // Check working schedule
            if (
                empty($doctor->working_days) ||
                empty($doctor->start_time) ||
                empty($doctor->end_time)
            ) {
                throw ValidationException::withMessages([
                    'doctor_id' => 'The doctor working schedule is not configured yet.',
                ]);
            }

            // Check working day
            $appointmentDay = Carbon::parse(
                $validated['appointment_date']
            )->format('l');

            if (!in_array($appointmentDay, $doctor->working_days)) {
                throw ValidationException::withMessages([
                    'appointment_date' => 'The doctor does not work on this day.',
                ]);
            }

            // Check working hours
            $appointmentTime = $validated['appointment_time'];
            $startTime = substr($doctor->start_time, 0, 5);
            $endTime = substr($doctor->end_time, 0, 5);

            if (
                $appointmentTime < $startTime ||
                $appointmentTime >= $endTime
            ) {
                throw ValidationException::withMessages([
                    'appointment_time' => 'Please choose a time within the doctor working hours.',
                ]);
            }

            // Check 30-minute slot interval
            $start = Carbon::createFromFormat('H:i', $startTime);
            $selected = Carbon::createFromFormat('H:i', $appointmentTime);

            $minutesDifference = $start->diffInMinutes($selected, false);

            if ($minutesDifference < 0 || $minutesDifference % 30 !== 0) {
                throw ValidationException::withMessages([
                    'appointment_time' => 'Please choose a valid available time slot.',
                ]);
            }

            // Prevent booking a time in the past
            $appointmentDateTime = Carbon::parse(
                $validated['appointment_date'] . ' ' . $appointmentTime
            );

            if ($appointmentDateTime->isPast()) {
                throw ValidationException::withMessages([
                    'appointment_time' => 'You cannot book an appointment in the past.',
                ]);
            }

            // Check existing appointments
            $existingAppointment = Appointment::where(
                'doctor_id',
                $doctor->id
            )
                ->whereDate('appointment_date', $validated['appointment_date'])
                ->where('appointment_time', $validated['appointment_time'])
                ->whereIn('status', ['pending', 'confirmed'])
                ->exists();

            if ($existingAppointment) {
                throw ValidationException::withMessages([
                    'appointment_time' => 'This time slot is already booked. Please choose another time.',
                ]);
            }

            // Create appointment
            Appointment::create([
                'user_id' => auth()->id(),
                'doctor_id' => $doctor->id,
                'appointment_date' => $validated['appointment_date'],
                'appointment_time' => $validated['appointment_time'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending',
            ]);
        });

        return redirect()
            ->route('home')
            ->with('success', 'Your appointment has been booked successfully!');
    }

    // Cancel patient's appointment
    public function cancel($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($appointment->status !== 'pending') {
            return back()->with(
                'error',
                'Only pending appointments can be cancelled.'
            );
        }

        $appointment->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment cancelled successfully!');
    }

    // Get booked time slots
    public function bookedTimes(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

        $doctor = Doctor::findOrFail($validated['doctor_id']);

        if (!$doctor->is_available) {
            return response()->json([
                'booked_times' => [],
                'message' => 'Doctor is not available.',
            ], 422);
        }

        $bookedTimes = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', $validated['appointment_date'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('appointment_time')
            ->map(fn ($time) => substr($time, 0, 5))
            ->values();

        return response()->json([
            'booked_times' => $bookedTimes,
        ]);
    }
}
