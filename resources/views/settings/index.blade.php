@extends('layouts.app') 

@section('content')
    <div class="container">
        <h1><strong>Settings</strong></h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Update Profile Form -->
        <div>
            <h2>Update Profile</h2>
            <form method="POST" action="{{ route('settings.updateProfile') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Picture -->
                <div class="form-group">
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture">
                </div>

                <!-- Submit Button -->
                <button type="submit">Update Profile</button>
            </form>
        </div>

        <!-- Change Password Form -->
        <div>
            <h2>Change Password</h2>
            <form method="POST" action="{{ route('settings.changePassword') }}">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" name="current_password" id="current_password" required>
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" id="new_password" required>
                </div>

                <!-- Confirm New Password -->
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password:</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                </div>

                <!-- Submit Button -->
                <button type="submit">Change Password</button>
            </form>
        </div>
    </div>
@endsection

@if(session('success'))
    <div class="alert alert-success" style="background-color: red;">{{ session('success') }}</div>
@endif
@push('styles')
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush
