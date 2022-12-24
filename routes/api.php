<?php
use Illuminate\Support\Facades\Route;
use App\Models\Apps;
Route::middleware("language")->group(function() {
    $files = glob(__DIR__ . "/api/*.php");
    foreach($files as $file) {
        require($file);
    }
    Route::any("/test", function(Request $request) {
        $a = Apps::create([
            "created_by" => "huy",
            "fullname" => "super"
        ]);
        var_dump($a->appid);
    });
});
Route::fallback( function(){
    return response()->json([
        'success' => false,
        'message' => '404 error!!!!!!!!!!!!!!!!!!!!!!!!!1'], 404);
});