<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Patient::with('user');

        // Search by name
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter by gender
        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        $patients = $query->get();

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'hospital_id' => 'required|string|max:255|unique:patients',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'emergency_contact' => 'required|string|max:255',
            'medical_history' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $patientRole = Role::where('name', 'Patient')->first();
        $user->roles()->attach($patientRole);

        Patient::create([
            'user_id' => $user->id,
            'hospital_id' => $request->hospital_id,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact,
            'medical_history' => $request->medical_history,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'hospital_id' => 'required|string|max:255|unique:patients,hospital_id,' . $patient->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'emergency_contact' => 'required|string|max:255',
            'medical_history' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $patient->update([
            'hospital_id' => $request->hospital_id,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact,
            'medical_history' => $request->medical_history,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;
        $patient->delete();
        $user->delete(); // Assuming cascade or manual delete

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}