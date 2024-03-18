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
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\DriverProfilecontroller;
use App\Http\Controllers\Admin\DispatchController;
use App\Http\Controllers\DriverDashboardController;
use App\Http\Controllers\Admin\DashboardController1;
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
    Route::get('admin/dashboard1', [DashboardController1::class, 'dashboard1'])->name('admin.dashboard1');
     
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard1', [DashboardController1::class, 'dashboard1'])->name('admin.dashboard1');
    });
});
// Patient routes
Route::resource('users', UserController::class)->only('show','edit','update')->middleware('auth');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');

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


//DRIVER ROUTES
// Driver's Profile
Route::get('/driver/CRUD', [DriverController::class, 'index'])->name('driver.CRUD.index');
Route::post('/driver/CRUD', [DriverController::class, 'store'])->name('driver.CRUD.store');
Route::get('/driver/CRUD/{id}/edit', [DriverController::class, 'edit'])->name('driver.CRUD.edit');
Route::put('/driver/CRUD/{id}', [DriverController::class, 'update'])->name('driver.CRUD.update');
Route::delete('/driver/CRUD/{id}', [DriverController::class, 'destroy'])->name('driver.CRUD.destroy');



//Admin SIDEBAR ROUTES 
//Manage User Routes
Route::get('/admin/patient', [PatientController::class, 'index'])->name('admin.patient.index');
Route::get('/admin/patient/create', [PatientController::class, 'create'])->name('admin.patient.create');
Route::post('/admin/patient', [PatientController::class, 'store'])->name('admin.patient.store');
Route::get('/admin/patient/{id}/edit', [PatientController::class, 'edit'])->name('admin.patient.edit');
Route::delete('/admin/patient/{id}', [PatientController::class, 'destroy'])->name('admin.patient.destroy');
Route::put('/admin/patient/{id}', [PatientController::class, 'update'])->name('admin.patient.update');


//Dispatching Responders
Route::post('/admin/dispatch/driver', [DispatchController::class, 'dispatchDriver'])->name('admin.dispatch.driver');
