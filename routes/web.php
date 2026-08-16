<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return redirect()->route('guest.home');
});
Route::get('/404', function() {
    return redirect()->route('guest.404');
});

 
Route::get('/login', function() {
    return redirect()->route('admin.login.view');
});
Route::post('send_email',[MailController::class,'index'])->name('sendMail');



Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth', 'role:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// TEMP: hapus route ini setelah selesai dipakai untuk clear cache di server
Route::get('/clear-cache-temp-xyz', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');

    return '<pre>' . Artisan::output() . '</pre>';
});
