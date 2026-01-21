<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Role-based routes
Route::middleware(['auth', 'role:Administrators'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Doctor management
    Route::resource('doctors', \App\Http\Controllers\DoctorController::class);

    // Staff management
    Route::resource('staff', \App\Http\Controllers\StaffController::class);
});

Route::middleware(['auth', 'role:Doctors'])->group(function () {
    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');
});

Route::middleware(['auth', 'role:Nurses'])->group(function () {
    Route::get('/nurse/dashboard', function () {
        return view('nurse.dashboard');
    })->name('nurse.dashboard');
});

// Example for multiple roles
Route::middleware(['auth', 'role:Front Desk/Billing Staff,Pharmacists/Lab Techs'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    // OPD management for front desk
    Route::get('/opd/create', [\App\Http\Controllers\OPDController::class, 'create'])->name('opd.create');
    Route::post('/opd', [\App\Http\Controllers\OPDController::class, 'store'])->name('opd.store');
    Route::get('/opd/search-patients', [\App\Http\Controllers\OPDController::class, 'searchPatients'])->name('opd.search-patients');
});

Route::middleware(['auth', 'role:Front Desk/Billing Staff,Pharmacists/Lab Techs,Doctors'])->group(function () {
    // OPD views for front desk and doctors
    Route::get('/opd', [\App\Http\Controllers\OPDController::class, 'index'])->name('opd.index');
    Route::get('/opd/patient/{patientId}', [\App\Http\Controllers\OPDController::class, 'show'])->name('opd.show');
});

// Appointments and Queues
Route::middleware(['auth', 'role:Front Desk/Billing Staff,Pharmacists/Lab Techs'])->group(function () {
    // Appointment management for front desk
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);

    // Queue management for front desk
    Route::resource('queues', \App\Http\Controllers\QueueController::class);
    Route::post('/queues/call-next', [\App\Http\Controllers\QueueController::class, 'callNext'])->name('queues.call-next');
    Route::post('/queues/{id}/serve', [\App\Http\Controllers\QueueController::class, 'serve'])->name('queues.serve');
    Route::post('/queues/{id}/cancel', [\App\Http\Controllers\QueueController::class, 'cancel'])->name('queues.cancel');
});

Route::middleware(['auth', 'role:Doctors'])->group(function () {
    // Appointments for doctors
    Route::get('/appointments', [\App\Http\Controllers\AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{id}', [\App\Http\Controllers\AppointmentController::class, 'show'])->name('appointments.show');

    // Queues for doctors
    Route::get('/queues', [\App\Http\Controllers\QueueController::class, 'index'])->name('queues.index');
    Route::get('/queues/{id}', [\App\Http\Controllers\QueueController::class, 'show'])->name('queues.show');
    Route::post('/queues/call-next', [\App\Http\Controllers\QueueController::class, 'callNext'])->name('queues.call-next');
    Route::post('/queues/{id}/serve', [\App\Http\Controllers\QueueController::class, 'serve'])->name('queues.serve');
    Route::post('/queues/{id}/cancel', [\App\Http\Controllers\QueueController::class, 'cancel'])->name('queues.cancel');
});

require __DIR__.'/auth.php';
