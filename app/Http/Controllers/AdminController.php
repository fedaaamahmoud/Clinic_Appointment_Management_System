<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Notifications\AppointmentStatusNotification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with([
            'patient',
            'doctor.specialty'
        ]);

        // Search by patient name, doctor name, or email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', function ($patientQuery) use ($search) {
                    $patientQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('doctor', function ($doctorQuery) use ($search) {
                    $doctorQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        // Filter by appointment status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by start date
        if ($request->filled('date_from')) {
            $query->whereDate('appointment_date', '>=', $request->date_from);
        }

        // Filter by end date
        if ($request->filled('date_to')) {
            $query->whereDate('appointment_date', '<=', $request->date_to);
        }

        $appointments = $query
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->get();

        // Dashboard statistics remain independent of filters
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $totalDoctors = Doctor::count();
        $totalPatients = User::where('role', 'patient')->count();

        return view('admin.dashboard', compact(
            'appointments',
            'totalAppointments',
            'pendingAppointments',
            'totalDoctors',
            'totalPatients'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,rejected',
        ]);

        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);

        if ($appointment->status !== 'pending') {
            return back()->with('error', 'Only pending appointments can be updated.');
        }

        $appointment->update([
            'status' => $validated['status'],
        ]);

        // Send one notification to the patient
        $appointment->patient->notify(
            new AppointmentStatusNotification($appointment, $validated['status'])
        );

        return redirect()->route('admin.dashboard', request()->only([
            'search',
            'status',
            'date_from',
            'date_to'
        ]))->with('success', 'Appointment status updated successfully!');
    }
}
