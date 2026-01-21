<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QueueController extends Controller
{
    /**
     * Display a listing of the queue for the authenticated doctor or all for staff.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $doctor = $user->doctor;
            $queues = Queue::where('doctor_id', $doctor->id)
                ->with('patient.user')
                ->orderBy('issued_time')
                ->get();
        } else {
            $queues = Queue::with('patient.user', 'doctor.user')
                ->orderBy('issued_time')
                ->get();
        }
        return view('queues.index', compact('queues'));
    }

    /**
     * Show the form for issuing a new token.
     */
    public function create()
    {
        $patients = Patient::with('user')->get();
        $doctors = Doctor::with('user')->get();
        return view('queues.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly issued token in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        // Generate token number, e.g., D001-001 where D001 is doctor code
        $doctor = Doctor::find($request->doctor_id);
        $lastToken = Queue::where('doctor_id', $request->doctor_id)
            ->whereDate('issued_time', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();
        $tokenNumber = $lastToken ? intval(substr($lastToken->token_number, -3)) + 1 : 1;
        $tokenNumber = 'D' . str_pad($doctor->id, 3, '0', STR_PAD_LEFT) . '-' . str_pad($tokenNumber, 3, '0', STR_PAD_LEFT);

        $queue = Queue::create([
            'token_number' => $tokenNumber,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'status' => 'waiting',
            'issued_time' => now(),
        ]);

        return redirect()->route('queues.index')->with('success', 'Token issued successfully.');
    }

    /**
     * Call the next patient in queue.
     */
    public function callNext(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $nextQueue = Queue::where('doctor_id', $request->doctor_id)
            ->where('status', 'waiting')
            ->orderBy('issued_time')
            ->first();

        if ($nextQueue) {
            $nextQueue->update(['status' => 'called']);
            return redirect()->route('queues.index')->with('success', 'Next patient called.');
        }

        return redirect()->route('queues.index')->with('error', 'No patients in queue.');
    }

    /**
     * Mark patient as served.
     */
    public function serve(Request $request, string $id)
    {
        $queue = Queue::findOrFail($id);
        $queue->update(['status' => 'served']);
        return redirect()->route('queues.index')->with('success', 'Patient served.');
    }

    /**
     * Cancel a queue entry.
     */
    public function cancel(Request $request, string $id)
    {
        $queue = Queue::findOrFail($id);
        $queue->update(['status' => 'cancelled']);
        return redirect()->route('queues.index')->with('success', 'Queue entry cancelled.');
    }

    /**
     * Display the specified queue entry.
     */
    public function show(string $id)
    {
        $queue = Queue::with('patient.user', 'doctor.user')->findOrFail($id);
        return view('queues.show', compact('queue'));
    }
}