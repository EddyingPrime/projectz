

@extends('layouts.app') <!-- Assuming you have a common layout for your views -->

@section('content')
    <h2>Admin Registration</h2>

    <form method="post" action="{{ route('admin.register') }}">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <input type="hidden" name="role" value="admin">

        <button type="submit">Register as Admin</button>
    </form>
@endsection
