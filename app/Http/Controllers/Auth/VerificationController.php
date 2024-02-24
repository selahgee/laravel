<?php
// app/Http/Controllers/Auth/VerificationController.php

// app/Http/Controllers/Auth/VerificationController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request; // Import the correct Request class

class VerificationController extends Controller
{
    use VerifiesEmails;

    // Redirect to the dashboard after email verification
    protected $redirectTo = '/dashboard';

    public function redirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * The user has been successfully verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function verified(Request $request)
    {
        return redirect($this->redirectPath())->with('verified', true);
    }
}

