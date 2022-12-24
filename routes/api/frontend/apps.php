<?php
use App\Http\Controllers\AppsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AuthToken;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix("app")->middleware("tokencheck")->group(function() {
    Route::post('/all', [AppsController::class, 'all']);
    Route::post('/create', [AppsController::class, 'create']);
    Route::middleware("appownercheck")->group(function() {
        Route::post('/get', [AppsController::class, 'get']);
    });
});