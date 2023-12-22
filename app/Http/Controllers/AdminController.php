<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation; // Import your Reservation model if needed

class AdminController extends Controller
{
    public function index()
    {
        // Retrieve reservations or any other data you want to display
        $reservations = Reservation::all(); // You can replace this with your actual query

        // Load the admin dashboard view with data
        return view('admin', compact('reservations'));
    }
}