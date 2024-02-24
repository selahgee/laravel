@extends('layouts.app')
@include('dashboard')
@section('title')

Profile
@endsection

@section('content')

<section class="content">
        
    <div class="">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img style="width: 50px;" class="profile-user-img img-fluid img-circle" src="{{ asset('images/avatar.jpg') }}">


                        </div>

                        <h3 class="profile-username text-center" style="text-transform: uppercase">{{ auth()->user()->name }} </h3>
                        {{--  <p class="text-muted text-center">{{ auth()->user()->role }}</p>  --}}
                        <p class="text-muted text-center" style="text-transform: uppercase">{{ auth()->user()->email }}</p>
                        <p class="text-muted text-center" style="text-transform: uppercase">{{ auth()->user()->phone }}</p>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div>

                            <div>
                                <form class="form-horizontal" method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name"><strong>Name:</strong></label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><strong>Email:</strong></label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"><strong>Phone:</strong></label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
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
        </div>
    </div>
</section>
@endsection

@push('styles')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endpush
