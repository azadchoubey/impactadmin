<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientsProfile;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageUsers;
use App\Livewire\Articles;
use App\Livewire\EditPublications;
use App\Livewire\KeywordSearch;
use App\Livewire\ShowClientProfile;
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
Route::get('/manageusers',[ManageUsers::class,'index']); 
Route::post('/adduser',[ManageUsers::class,'adduser'])->name('adduser');
Route::post('/edituser',[ManageUsers::class,'edituser'])->name('edituser');
Route::view('/change-password', 'change-password')->name('changepassword');
// client profile routes
Route::get('/clients',ShowClientProfile::class);
Route::get('/clients/{id}',[ClientsProfile::class,'index'])->name('clients');

//  publications routes
Route::view('/publications','publications/index');
Route::view('/createpublication','createpublication')->name('createpub');
Route::get('/editpublication/{id}',EditPublications::class)->name('editpublication');

// article routes 
Route::get('/articles',Articles::class);
Route::get('/article/{id}',[ArticleController::class,'viewarticle'])->name('viewarticle');

Route::get('/keywordsearch',KeywordSearch::class);
});

