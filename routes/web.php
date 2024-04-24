<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientsProfile;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageUsers;
use App\Livewire\Articles;
use App\Livewire\CreatePublication;
use App\Livewire\EditPublications;
use App\Livewire\KeywordSearch;
use App\Livewire\ShowClientProfile;
use Illuminate\Support\Facades\Route;
use App\Models\Mongo\ClientContact;
use Maatwebsite\Excel\Row;

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
Route::get('/enabledisable/{id}',[ManageUsers::class,'enabledisable'])->name('enabledisable');


// client profile routes
Route::get('/clients',ShowClientProfile::class);
Route::get('/clients/{id}',[ClientsProfile::class,'index'])->name('clients');
Route::post('/editclient/{id}', [ClientsProfile::class,'edit'])->name('editclient');
Route::get('/addclient',[ClientsProfile::class,'addclient'])->name('addclient');
Route::post('/createclient',[ClientsProfile::class,'create'])->name('createclient');
Route::get('/get-subsectors/{industry}', [ClientsProfile::class,'getSubsectors']);
Route::post('/addcontact',[ClientsProfile::class,'addcontact'])->name('addcontact');
Route::post('/editcontact',[ClientsProfile::class,'editContact'])->name('editcontact');


//  publications routes
Route::view('/publications','publications/index');
Route::get('/createpublication',CreatePublication::class)->name('createpub');
Route::get('/editpublication/{id}',EditPublications::class)->name('editpublication');

// article routes 
Route::get('/articles',Articles::class);
Route::get('/article/{id}',[ArticleController::class,'viewarticle'])->name('viewarticle');

Route::get('/keywordsearch',KeywordSearch::class);

Route::get('/test',function(){
    return ClientContact::where('Client_Name','Accenture')->get();
});
});

