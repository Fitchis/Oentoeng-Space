<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $bookings = Booking::where('user_id', Auth::id())->get();




        return view('user.dashboard', compact('bookings'));
    }
}
