<?php

use App\Models\Picklist;
use App\Livewire\Articles;
use Maatwebsite\Excel\Row;
use App\Livewire\KeywordSearch;
use App\Livewire\EditPublications;
use App\Models\CustomDigestFormat;
use App\Livewire\CreatePublication;
use App\Livewire\ShowClientProfile;
use App\Models\Mongo\ClientContact;
use App\Http\Controllers\ManageUsers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsProfile;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\KeywordController;

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
Route::post('/get-delivery-times', [ClientsProfile::class, 'getDeliveryTimes'])->name('getdelivery');


//  publications routes
Route::view('/publications','publications/index');
Route::get('/createpublication',CreatePublication::class)->name('createpub');
Route::get('/editpublicaticon/{id}',EditPublications::class)->name('editpublication');

// article routes 
Route::get('/articles',Articles::class);
Route::get('/article/{id}/{id2}',[ArticleController::class,'viewarticle'])->name('viewarticle');

Route::get('/keywordsearch',KeywordSearch::class);
Route::post('/saveArticle', [ArticleController::class, 'saveArticle'])->name('keywords.saveArticle');
Route::post('/save-keyword', [KeywordController::class, 'saveKeyword'])->name('save.keyword');
Route::post('/edit-keyword', [KeywordController::class, 'editKeyword'])->name('edit.keyword');
Route::post('/addcomment', [ClientsProfile::class, 'addComment'])->name('addcomment');

//report download 
Route::get('/downloadmediauniverse',[ClientsProfile::class,'downloadMediaUniverseReport'])->name('downloadmediauniverse');


Route::get('/test',function(){
    return Picklist::where('type','keyword category')->orderBy('name')->get();
});

});

