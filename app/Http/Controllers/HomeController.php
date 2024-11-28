<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('field', 'user')->get();
        $fields = Field::all();
        $users = User::all();

        return view('admin.dashboard', compact('bookings', 'fields', 'users'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Booking::create([
            'field_id' => $request->field_id,
            'user_id' => $request->user_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil ditambahkan!');
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:confirmed,canceled',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }
}
