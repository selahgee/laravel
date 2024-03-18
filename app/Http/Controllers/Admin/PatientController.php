<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::where('role', 'patient')->get();
        return view('admin.patient.index', ['patients' => $patients]);
    }

    public function create()
    {
        return view('admin.patient.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');  
        $user->password = Hash::make($request->input('password'));   
        $user->passport = $request->input('passport');
        $user->phone = $request->input('phone');
        $user->age = $request->input('age');
        $user->allergies = $request->input('allergies');
        $user->disabilities = $request->input('disabilities');
        $user->role = 'patient';
        $user->save();

        return redirect()->route('admin.patient.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $patient = User::findOrFail($id);
        return view('admin.patient.edit', ['patient' => $patient]);
    }

   
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.patient.index')->with('success', 'User deleted successfully!');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        // Add validation rules for other fields if needed
    ]);

    $patient = User::findOrFail($id);
    $patient->name = $request->input('name');
    $patient->email = $request->input('email');
    $patient->passport = $request->input('passport');
    $patient->phone = $request->input('phone');
    $patient->age = $request->input('age');
    $patient->allergies = $request->input('allergies');
    $patient->disabilities = $request->input('disabilities');
    $patient->save();

    return redirect()->route('admin.patient.index')->with('success', 'Patient information updated successfully.');
}
}
