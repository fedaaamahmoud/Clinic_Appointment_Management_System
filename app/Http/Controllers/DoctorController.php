<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Doctor profile not found.');
        }

        $appointments = $doctor->appointments()
            ->with('patient')
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->get();

        return view('doctor.dashboard', compact('doctor', 'appointments'));
    }
}
