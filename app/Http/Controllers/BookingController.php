<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $fields = Field::where('availability', true)->get();
        return view('bookings.index', compact('fields'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
        ]);

        // Cek apakah lapangan sudah dibooking pada tanggal dan waktu tersebut
        $existingBooking = Booking::where('field_id', $request->field_id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'Waktu yang Anda pilih sudah dibooking. Silakan pilih waktu lain!');
        }

        // Jika tidak ada booking, simpan booking baru
        Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $request->field_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return redirect()->route('welcome')->with('success', 'Booking berhasil dibuat. Tunggu konfirmasi!');
    }
    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak bisa membatalkan booking orang lain!');
        }

        $booking->update(['status' => 'canceled']);
        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibatalkan!');
    }

    public function getBookingsByDate(Request $request)
    {
        $date = $request->get('date', today());

        // Ambil data booking berdasarkan tanggal yang dipilih
        $bookingsToday = Booking::whereDate('date', $date)
            ->with('user')
            ->get();

        // Format data untuk tabel booking
        $bookingTable = view('partials.booking-table', compact('bookingsToday'))->render();

        // Format data untuk tabel waktu 07:00 - 23:00
        $timeTable = view('partials.time-table', compact('bookingsToday'))->render();

        return response()->json([
            'bookingTable' => $bookingTable,
            'timeTable' => $timeTable,
            'selectedDate' => \Carbon\Carbon::parse($date)->format('l, d/m/Y'),
        ]);
    }
}
