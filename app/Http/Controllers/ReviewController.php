<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Get the appointment
        $appointment = Appointment::findOrFail($validated['appointment_id']);

        // Make sure the appointment belongs to the logged-in patient
        if ($appointment->user_id !== auth()->id()) {
            abort(403, 'You are not allowed to review this appointment.');
        }

        // Only confirmed appointments can be reviewed
        if ($appointment->status !== 'confirmed') {
            return back()->with('error', 'Only confirmed appointments can be reviewed.');
        }

        // Make sure the appointment date and time have passed
        $appointmentDateTime = Carbon::parse(
            $appointment->appointment_date . ' ' . $appointment->appointment_time
        );

        if (!$appointmentDateTime->isPast()) {
            return back()->with('error', 'You can review the doctor after your appointment.');
        }

        // Prevent duplicate reviews
        if (Review::where('appointment_id', $appointment->id)->exists()) {
            return back()->with('error', 'You have already reviewed this appointment.');
        }

        // Create review
        Review::create([
            'user_id' => auth()->id(),
            'doctor_id' => $appointment->doctor_id,
            'appointment_id' => $appointment->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with('success', 'Your review has been submitted successfully!');
    }
}

