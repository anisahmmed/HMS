<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('user')->get();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'specialization' => 'required|string|max:255',
            'bmdc_registration_number' => 'required|string|max:255|unique:doctors',
            'qualifications' => 'required|string',
            'experience_years' => 'nullable|integer',
            'bio' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $doctorRole = Role::where('name', 'Doctor')->first();
        $user->roles()->attach($doctorRole);

        Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization,
            'bmdc_registration_number' => $request->bmdc_registration_number,
            'qualifications' => $request->qualifications,
            'experience_years' => $request->experience_years,
            'bio' => $request->bio,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'specialization' => 'required|string|max:255',
            'bmdc_registration_number' => 'required|string|max:255|unique:doctors,bmdc_registration_number,' . $doctor->id,
            'qualifications' => 'required|string',
            'experience_years' => 'nullable|integer',
            'bio' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $doctor->update([
            'specialization' => $request->specialization,
            'bmdc_registration_number' => $request->bmdc_registration_number,
            'qualifications' => $request->qualifications,
            'experience_years' => $request->experience_years,
            'bio' => $request->bio,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user;
        $doctor->delete();
        $user->delete(); // Assuming cascade or manual delete

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
