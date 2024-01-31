<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Pubmaster;
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
Route::middleware(['guest'])->group(function () {
    Route::view('/','login' )->name('login');
    // Route::post('/login',[LoginController::class,'authenticate'])->name('authenticate');
});

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', function () {return view('admin');})->name('dashboard');
Route::view('/change-password', 'change-password')->name('changepassword');
Route::view('/publications','publications/index');
Route::view('/clients','clients');

});
Route::get('/publication',function(){
return Pubmaster::with('Type','City','Country','State','Language')->select('PubId','Title','Type','CityID','countryID','stateID','Language')->find(8773);
});

