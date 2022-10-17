<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Base\Auth\AuthController;


Route::group(['prefix' => 'admin/'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => 'auth.verify'], function () {
        Route::get('user/profile', [AuthController::class, 'getUser']);
    });
});

?>