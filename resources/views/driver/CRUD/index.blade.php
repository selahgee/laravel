@extends('layouts.app')
@section('content')
   <div class="container " style="margin: 0 auto; width: 50%;">
        <div class="row">
            <div class="col-md-3" >
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img style="width: 50px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/avatar.jpg') }}">
                        </div>
                        <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                        <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                        <p class="text-muted text-center">{{ auth()->user()->contact_number }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('driver.CRUD.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <strong><label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>:</strong>
                                <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" readonly>
                            </div>
                            <div class="form-group row">
                                <strong><label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>:</strong>
                                <input id="email" type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="form-group row">
                                <strong><label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>:</strong>
                                <input id="contact_number" type="text" class="form-control" name="contact_number" required>
                            </div>
                            <div class="form-group row">
                                <strong><label for="current_location" class="col-md-4 col-form-label text-md-right">{{ __('Current Location') }}</label>:</strong>
                                <input id="current_location" type="text" class="form-control" name="current_location" required>
                            </div>
                            <div class="form-group row">
                                <strong><label for="number_plate" class="col-md-4 col-form-label text-md-right">{{ __('Number Plate') }}</label>:</strong>
                                <input id="number_plate" type="text" class="form-control" name="number_plate" required>
                            </div>
                            <div class="form-group row">
                                <strong><label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>:</strong>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="available">Available</option>
                                    <option value="not available">Not Available</option>
                                </select>
                            </div>
                          
                            <div class="form-group row mb-0">
                                <div class="button">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
<link href="{{ asset('css/profile1.css') }}" rel="stylesheet">
@endpush
