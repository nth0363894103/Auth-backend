<?php
use Illuminate\Support\Facades\Route;


Route::prefix('frontend')->group(function () {
    $files = glob(__DIR__ . "/frontend/*.php");
    foreach($files as $file) {
            require($file);
    }
});
