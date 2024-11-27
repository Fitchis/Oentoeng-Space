<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $bookings = Booking::where('user_id', Auth::id())->get();
        $hour = now()->format('H');
        $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');



        return view('user.dashboard', compact('bookings', 'hour', 'greeting'));
    }
}
