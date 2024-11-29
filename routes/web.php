<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;

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


Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticationLogin'])->name('user.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [ContentController::class, 'tampil'])->name('dashboard');
// Route::get('/', function () {
//     return view('login');
// });

// // Mengarahkan ke halaman login jika belum login
// Route::get('/', function () {
//     if (auth()->check()) {
//         return redirect()->route('dashboard');
//     }
//     return view('login');
// })->name('login.form');

// // Route untuk login form dan proses login menggunakan API
// Route::get('/login', [AuthController::class, 'index']); // Halaman Login
// Route::post('/login', [AuthController::class, 'login']); // Proses login

// // Dashboard hanya bisa diakses dengan token valid
// Route::get('/dashboard', function () {
//     return view('dashboard'); // Halaman dashboard setelah login
// })->middleware('auth:api')->name('dashboard');

// // Route untuk logout
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
