<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Define the root URL route
Route::get('/', function () {
    return view('auth.welcome'); // Update this line to point to the correct path
});

// Define the dashboard route
//Route::middleware(['auth'])->get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

// Laravel's built-in authentication routes
Auth::routes(['register' => false, 'verify' => true]);
// Route for registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [IndexController::class, 'index'])->name('admin.dashboard');
    });
});
// Patient routes
Route::resource('users', UserController::class)->only('show','edit','update')->middleware('auth');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');




//Route::get('/profile', [UserController::class,'profile'])->name('user.profile');
//Route::post('/profile', 'UserController@profile')->name('user.postProfile');

// Booking routes 
Route::get('/book-ambulance', [AmbulanceController::class, 'showBookingForm'])->name('ambulance.booking.form');
Route::post('/book-ambulance', [AmbulanceController::class, 'bookAmbulance'])->name('ambulance.booking');


Route::post('/save-booking', [BookingController::class, 'saveBooking'])->name('save.booking');

Route::get('/api/hospitals/nearby', [HospitalController::class, 'nearby']);
