<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => 'auth:api', // Proteksi dengan JWT
], function () {
    Route::get('contents', [ContentController::class, 'index']); // List with search & paginate
    Route::post('contents', [ContentController::class, 'store']); // Create content
    Route::get('contents/{id}', [ContentController::class, 'show']); // Read content by ID
    Route::put('contents/{id}', [ContentController::class, 'update']); // Update content by ID
    Route::delete('contents/{id}', [ContentController::class, 'destroy']); // Delete content by ID
});
