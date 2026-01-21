<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OPDController extends Controller
{
    public function create()
    {
        $doctors = Doctor::all();
        return view('opd.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'fee_amount' => 'required|numeric|min:0',
            'visit_time' => 'nullable|date_format:H:i',
        ]);

        // Generate unique ticket number
        $ticketNumber = 'OPD-' . date('Ymd') . '-' . str_pad(Visit::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

        Visit::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'visit_type' => 'OPD',
            'visit_date' => today(),
            'visit_time' => $request->visit_time,
            'ticket_number' => $ticketNumber,
            'fee_amount' => $request->fee_amount,
            'fee_paid' => false,
            'status' => 'pending',
        ]);

        return redirect()->route('opd.index')->with('success', 'OPD ticket created successfully.');
    }

    public function index()
    {
        $currentOPDVisits = Visit::where('visit_type', 'OPD')
            ->where('visit_date', today())
            ->with(['patient.user', 'doctor.user'])
            ->orderBy('visit_time')
            ->get();

        return view('opd.index', compact('currentOPDVisits'));
    }

    public function show($patientId)
    {
        $patient = Patient::with('user')->findOrFail($patientId);
        $visitHistory = Visit::where('patient_id', $patientId)
            ->where('visit_type', 'OPD')
            ->with('doctor.user')
            ->orderBy('visit_date', 'desc')
            ->get();

        return view('opd.show', compact('patient', 'visitHistory'));
    }

    public function searchPatients(Request $request)
    {
        $query = $request->get('q');
        $patients = Patient::whereHas('user', function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%");
        })->orWhere('hospital_id', 'like', "%{$query}%")
          ->with('user')
          ->limit(10)
          ->get();

        return response()->json($patients);
    }
}
