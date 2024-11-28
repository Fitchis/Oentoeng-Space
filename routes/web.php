<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;



Route::middleware(['auth', 'admin'])->group(function () {
    // Menampilkan semua data booking
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    // Update status booking
    Route::post('/admin/bookings/{booking}/status', [HomeController::class, 'updateBookingStatus'])->name('admin.updateBookingStatus');

    Route::post('/admin/bookings', [HomeController::class, 'storeBooking'])->name('admin.storeBooking');
    // Menghapus booking
    Route::delete('/admin/bookings/{booking}', [HomeController::class, 'deleteBooking'])->name('admin.deleteBooking');

    // Menambahkan field baru
    Route::post('/admin/fields', [HomeController::class, 'storeField'])->name('admin.storeField');

    // Menghapus field
    Route::delete('/admin/fields/{field}', [HomeController::class, 'deleteField'])->name('admin.deleteField');
});
Route::middleware('auth')->post('/booking/{booking}/cancel', [BookingController::class, 'cancelBooking'])->name('cancelBooking');
Route::get('/api/bookings', [BookingController::class, 'getBookingsByDate']);

Route::get('/', function () {
    // Ambil data lapangan (satu lapangan)
    $field = App\Models\Field::first();  // Mengambil lapangan pertama, karena hanya ada satu
    if (!$field) {
        return view('welcome', ['field' => null, 'bookingsToday' => collect()]);
    }
    // Ambil jadwal booking untuk hari ini
    $bookingsToday = App\Models\Booking::where('field_id', $field->id)
        ->whereDate('date', today()) // Menampilkan booking hari ini saja
        ->get();

    return view('welcome', compact('field', 'bookingsToday'));  // Kirim data field dan bookingsToday ke view welcome
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->get('/dashboard', [UserController::class, 'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/admin/bookings/{id}', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/admin/bookings/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
});

// Rute logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


require __DIR__ . '/auth.php';
