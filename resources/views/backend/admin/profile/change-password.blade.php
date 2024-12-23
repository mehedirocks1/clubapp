@extends('backend.admin.layout.app')

@section('content')
    <h1>Change Password</h1>
    <form action="{{ route('admin.changePassword') }}" method="POST">
        @csrf
        @method('POST')
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Change Password</button>
    </form>
@endsection
