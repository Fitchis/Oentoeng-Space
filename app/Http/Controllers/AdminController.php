<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $bookings = Booking::with('field', 'user')->get();
        $fields = Field::all();

        return view('admin.dashboard', compact('bookings', 'fields'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:confirmed,canceled',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }

    public function storeField(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Field::create($request->all());

        return redirect()->back()->with('success', 'Lapangan berhasil ditambahkan!');
    }

    public function deleteField(Field $field)
    {
        $field->delete();

        return redirect()->back()->with('success', 'Lapangan berhasil dihapus!');
    }
}
