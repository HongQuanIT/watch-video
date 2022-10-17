<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostmanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/postman', [PostmanController::class, 'index'])->name('file.download.index');

Route::group(array('domain' => config('app.admin_url')), function()
{
    Route::get('/{any?}', function() {
        return view('admin');
    });
    Route::get('/{any1?}/{any2?}', function() {
        return view('admin');
    });
});

Route::get('/', function () {
    return view('welcome');
});
