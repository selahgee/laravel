<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DriverProfilecontroller;
use App\Http\Controllers\DriverDashboardController;
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

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');


//Route::post('/save-booking', [BookingController::class, 'saveBooking'])->name('save.booking');

Route::get('/api/hospitals/nearby', [HospitalController::class, 'nearby']);


//navbar route
Route::get('/navbar', [NavbarController::class, 'index'])->name('navbar');

//logout route
Route::get('/logout', function () {
    return view('logout');
})->name('logout');
;

Route::get('/logout/perform', function () {
    Auth::logout(); // Perform logout
    return redirect('/');
})->name('logout.perform');



//notification Routes
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-multiple-as-read', [NotificationController::class, 'markMultipleAsRead'])->name('notifications.markMultipleAsRead');
    Route::delete('/notifications/{notification}/delete', [NotificationController::class, 'delete'])->name('notifications.delete');
    Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications'])->name('notifications.unread');
    Route::get('/notifications/unread/count', [NotificationController::class, 'getUnreadNotificationsCount'])->name('notifications.unreadCount');
});
//settings route
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::put('/settings/update-profile', [SettingsController::class, 'updateProfile'])->name('settings.updateProfile');
Route::put('/settings/change-password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');

//Driver's Dashboard Routes 
Route::middleware(['auth', 'driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])->name('driver.dashboard');
    Route::post('/driver/booking/{id}/accept', [DriverDashboardController::class, 'acceptBooking'])->name('driver.booking.accept');
    Route::post('/driver/booking/{id}/decline', [DriverDashboardController::class, 'declineBooking'])->name('driver.booking.decline');
});

//Driver Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/driver/profile', [DriverProfileController::class, 'index'])->name('driver.profile');
    Route::put('driver/profile/update', [DriverProfilecontroller::class, 'update'])->name('driver.profile.update');
});

// Drivers CRUD Routes
