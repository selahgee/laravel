@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>PATIENTS</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.patient.create') }}" class="btn btn-primary">Add User</a>
            </div>
        </div>
        <div class="text-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>                    
                    <th>ID/passport</th>
                    <th>phone</th>
                    <th>age</th>
                <th>Allergies</th>
                <th>Disabilities</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->passport }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->age }}</td>
                        <td>{{ $patient->allergies }}</td>
                        <td>{{ $patient->disabilities }}</td>
                        <!--action buttons-->
                    <td>
                        <a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
   
                        
@endsection
@push('styles')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush