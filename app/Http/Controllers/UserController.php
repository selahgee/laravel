<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
  
        return view ('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view ('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
  
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'passport' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'age' => 'nullable|string|max:20',
            'allergies' => 'required|string|max:255',
            'disabilities' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'passport' => $request->input('passport'),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'allergies' => $request->input('allergies'),
            'disabilities' => $request->input('disabilities'),
        ]);

        // Redirect the user to their profile page after the update
        return redirect()->route('users.show', $user)->with('success', 'Profile updated successfully');
    }

    
}
