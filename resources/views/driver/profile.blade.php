@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
@include('dashboard')
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
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
                        <form class="form-horizontal" method="POST" action="{{ route('driver.profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row"><strong>
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>:</strong>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">                                
                            </div>
                            <div class="form-group row"><strong>
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>:</strong>                                
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                                </div>
                            
                            <div class="form-group row"><strong>
                                <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>:</strong>                             
                                    <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ $user->contact_number }}">
                                
                            </div>
                            <div class="form-group row"><strong>
                                <label for="current_location" class="col-md-4 col-form-label text-md-right">{{ __('Current Location') }}</label>:</strong>                              
                                    <input id="current_location" type="text" class="form-control" name="current_location" value="{{$user->current_location }}">
                                </div>
                            
                                <div class="form-group row"><strong>
                                    <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>:</strong>
                                    <div class="col-md-6">
                                        <select id="status" class="form-control" name="status">
                                            <option value="available" {{ $user->status === 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="not available" {{ $user->status === 'not available' ? 'selected' : '' }}>Not Available</option>
                                        </select>
                                    </div>
                                </div>
                                
                           
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="button">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link href="{{ asset('css/profile1.css') }}" rel="stylesheet">
@endpush
