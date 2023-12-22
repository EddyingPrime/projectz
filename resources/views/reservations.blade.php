

@extends('layouts.admin')

@section('content')
    <h2>Welcome to the Admin Dashboard</h2>

    <div>
        <!-- Your admin dashboard content goes here -->
        <!-- Example: Display a table for reservations -->
        <table border="1">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Place</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->time }}</td>
                        <td>{{ $reservation->place }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
