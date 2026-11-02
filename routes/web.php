<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminSpecialtyController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Appointment Routes
Route::get('/appointments/create', [AppointmentController::class, 'create'])
    ->middleware('auth')
    ->name('appointments.create');

Route::get('/appointments/booked-times', [AppointmentController::class, 'bookedTimes'])
    ->middleware('auth')
    ->name('appointments.bookedTimes');

Route::post('/appointments', [AppointmentController::class, 'store'])
    ->middleware('auth')
    ->name('appointments.store');

Route::get('/appointments', [AppointmentController::class, 'index'])
    ->middleware('auth')
    ->name('appointments.index');

// Cancel Appointment
Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])
    ->middleware('auth')
    ->name('appointments.cancel');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('dashboard');

    Route::patch('/appointments/{id}/status', [AdminController::class, 'updateStatus'])
    ->name('appointments.updateStatus');

    Route::get('/doctors', [AdminDoctorController::class, 'index'])
    ->name('doctors.index');

    Route::get('/doctors/create', [AdminDoctorController::class, 'create'])
    ->name('doctors.create');

    Route::post('/doctors', [AdminDoctorController::class, 'store'])
    ->name('doctors.store');

    Route::get('/doctors/{id}/edit', [AdminDoctorController::class, 'edit'])
    ->name('doctors.edit');

    Route::put('/doctors/{id}', [AdminDoctorController::class, 'update'])
    ->name('doctors.update');

    Route::delete('/doctors/{id}', [AdminDoctorController::class, 'destroy'])
    ->name('doctors.destroy');

    Route::patch('/doctors/{id}/availability', [AdminDoctorController::class, 'toggleAvailability'])
    ->name('doctors.toggleAvailability');

    // Manage Specialties
    Route::get('/specialties', [AdminSpecialtyController::class, 'index'])
    ->name('specialties.index');

    Route::get('/specialties/create', [AdminSpecialtyController::class, 'create'])
    ->name('specialties.create');

    Route::post('/specialties', [AdminSpecialtyController::class, 'store'])
    ->name('specialties.store');

    Route::get('/specialties/{id}/edit', [AdminSpecialtyController::class, 'edit'])
    ->name('specialties.edit');

    Route::put('/specialties/{id}', [AdminSpecialtyController::class, 'update'])
    ->name('specialties.update');

    Route::delete('/specialties/{id}', [AdminSpecialtyController::class, 'destroy'])
    ->name('specialties.destroy');

});

// Doctor Routes
Route::middleware(['auth', 'doctor'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {

        Route::get('/dashboard', [DoctorController::class, 'index'])
            ->name('dashboard');

    });

// Notification Routes
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.markAsRead');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.markAllAsRead');
    
    Route::post('/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store');
});