<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments for the authenticated doctor.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $doctor = $user->doctor;
            $appointments = Appointment::where('doctor_id', $doctor->id)
                ->with('patient.user')
                ->orderBy('date')
                ->orderBy('time')
                ->get();
        } else {
            // For staff/front desk, show all or filtered
            $appointments = Appointment::with('patient.user', 'doctor.user')
                ->orderBy('date')
                ->orderBy('time')
                ->get();
        }
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $patients = Patient::with('user')->get();
        $doctors = Doctor::with('user')->get();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'scheduled',
            'notes' => $request->notes,
        ]);

        // Placeholder for SMS notification
        // SendSMS::send($appointment->patient->user->phone, 'Your appointment is scheduled for ' . $appointment->date . ' at ' . $appointment->time);

        return redirect()->route('appointments.index')->with('success', 'Appointment scheduled successfully.');
    }

    /**
     * Display the specified appointment.
     */
    public function show(string $id)
    {
        $appointment = Appointment::with('patient.user', 'doctor.user')->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::with('user')->get();
        $doctors = Doctor::with('user')->get();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(Request $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:scheduled,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($request->only(['patient_id', 'doctor_id', 'date', 'time', 'status', 'notes']));

        if ($request->status == 'confirmed') {
            // Placeholder for SMS notification
            // SendSMS::send($appointment->patient->user->phone, 'Your appointment is confirmed for ' . $appointment->date . ' at ' . $appointment->time);
        }

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Export appointments for a specific doctor as PDF.
     */
    public function exportDoctorAppointments($doctorId)
    {
        $doctor = Doctor::with('user')->findOrFail($doctorId);
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->with('patient.user')
            ->orderBy('serial_number')
            ->get();

        $pdf = PDF::loadView('appointments.doctor-pdf', compact('doctor', 'appointments'));

        $filename = 'doctor_' . $doctor->user->name . '_appointments_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}