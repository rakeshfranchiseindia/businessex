<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});


Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/quick-register', [AuthController::class, 'quickRegister'])->name('quick.register');;
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::post('/register-custom', function (Request $request) {
    // Handle form submission here
    // Example: dump the request data
    // dd($request->all());

    return back()->with('success', 'Form submitted successfully!');
})->name('register.custom');
