

@extends('layouts.admin')

@section('content')
    <h2>Reservation Data</h2>
    
    <table>
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
@endsection
