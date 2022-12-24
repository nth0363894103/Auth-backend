<?php
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AuthToken;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix("user")->group(function() {
    Route::post('/login', [UsersController::class, 'login']);
    Route::post('/register', [UsersController::class, 'register']);
    Route::middleware('tokencheck')->group(function () {
        Route::any('/get', [UsersController::class, 'get']);
        Route::post('/logout', [UsersController::class, 'logout']);
    });
});