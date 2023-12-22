<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function index()
    {
        // Retrieve reservation data (adjust the query based on your model)
        $reservations = Reservation::all();

        // Load the reservations view with data
        return view('reservations', compact('reservations'));
    }
}