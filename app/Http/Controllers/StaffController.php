<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    private $roleMapping = [
        'nurse' => 'Nurses',
        'front_desk' => 'Front Desk/Billing Staff',
        'pharmacist' => 'Pharmacists/Lab Techs',
        'lab_tech' => 'Pharmacists/Lab Techs',
        'it_admin' => 'IT Admins',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::with('user')->get();
        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create');
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
            'staff_type' => 'required|in:nurse,front_desk,pharmacist,lab_tech,it_admin',
            'department' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $roleName = $this->roleMapping[$request->staff_type];
        $role = Role::where('name', $roleName)->first();
        $user->roles()->attach($role);

        Staff::create([
            'user_id' => $user->id,
            'staff_type' => $request->staff_type,
            'department' => $request->department,
            'hire_date' => $request->hire_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = Staff::with('user')->findOrFail($id);
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = Staff::with('user')->findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staff = Staff::findOrFail($id);
        $user = $staff->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'staff_type' => 'required|in:nurse,front_desk,pharmacist,lab_tech,it_admin',
            'department' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Update role if staff_type changed
        $newRoleName = $this->roleMapping[$request->staff_type];
        $currentRole = $user->roles()->first();
        if ($currentRole && $currentRole->name !== $newRoleName) {
            $newRole = Role::where('name', $newRoleName)->first();
            $user->roles()->detach($currentRole);
            $user->roles()->attach($newRole);
        }

        $staff->update([
            'staff_type' => $request->staff_type,
            'department' => $request->department,
            'hire_date' => $request->hire_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::findOrFail($id);
        $user = $staff->user;
        $staff->delete();
        $user->delete();

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }
}
