<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::post('/login', [HomeController::class, 'login'])->name('login');

Route::post('/signup', [HomeController::class, 'signup'])->name('signup');

Route::get('/doctor-data', [HomeController::class, 'doctorData'])->name('doctor-data');

Route::post('/book-appointment', [HomeController::class, 'bookAppointment'])->name('book-appointment');
