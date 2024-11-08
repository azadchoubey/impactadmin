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
use App\Http\Controllers\WebUniverse;

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
Route::get('/manageusers',[ManageUsers::class,'index'])->name('manageusers'); 
Route::post('/adduser',[ManageUsers::class,'adduser'])->name('adduser');
Route::post('/edituser',[ManageUsers::class,'edituser'])->name('edituser');
Route::view('/change-password', 'change-password')->name('changepassword');
Route::get('/enabledisable/{id}',[ManageUsers::class,'enabledisable'])->name('enabledisable');


// client profile routes
Route::get('/clients',ShowClientProfile::class)->name('client');
Route::get('/clients/{id}',[ClientsProfile::class,'index'])->name('clients');
Route::post('/editclient/{id}', [ClientsProfile::class,'edit'])->name('editclient');
Route::get('/addclient',[ClientsProfile::class,'addclient'])->name('addclient');
Route::post('/createclient',[ClientsProfile::class,'create'])->name('createclient');
Route::get('/get-subsectors/{industry}', [ClientsProfile::class,'getSubsectors']);
Route::post('/addcontact',[ClientsProfile::class,'addcontact'])->name('addcontact');
Route::post('/editcontact',[ClientsProfile::class,'editContact'])->name('editcontact');
Route::post('/get-delivery-times', [ClientsProfile::class, 'getDeliveryTimes'])->name('getdelivery');
Route::post('/get-delivery-times-weekend', [ClientsProfile::class, 'getDeliveryTimesweek'])->name('getdeliveryweek');
Route::get('/export-clients', [ClientsProfile::class, 'export'])->name('clients.export');
Route::get('/export-client-details', [ClientsProfile::class, 'exportDetails'])->name('clients.exportDetails');
Route::get('/export-brand-strings', [ClientsProfile::class, 'exportBrandStrings'])->name('clients.exportBrandStrings');
Route::post('/update-checkbox', [ClientsProfile::class, 'updateCheckbox'])->name('update.checkbox');
Route::get('/media/universe/content', [ClientsProfile::class, 'loadMediaUniverseContent'])->name('loadMediaUniverseContent');
Route::post('/saveSelectedRssFeeds', [ClientsProfile::class, 'saveSelectedRssFeeds'])->name('saveSelectedRssFeeds');
Route::post('/deleteSelectedRssFeeds', [ClientsProfile::class, 'delSelectedRssFeeds'])->name('deleteSelectedRssFeeds');
Route::post('/reset-record', [ClientsProfile::class, 'resetRecord'])->name('reset.record');



//  publications routes
Route::view('/publications','publications/index')->name('publications');
Route::get('/createpublication',CreatePublication::class)->name('createpub');
Route::get('/editpublicaticon/{id}',EditPublications::class)->name('editpublication');

// article routes 
Route::get('/articles',Articles::class)->name('articles');
Route::get('/article/{id}/{id2}',[ArticleController::class,'viewarticle'])->name('viewarticle');

Route::get('/keywordsearch',KeywordSearch::class);
Route::post('/saveArticle', [ArticleController::class, 'saveArticle'])->name('keywords.saveArticle');
Route::post('/save-keyword', [KeywordController::class, 'saveKeyword'])->name('save.keyword');
Route::post('/edit-keyword', [KeywordController::class, 'editKeyword'])->name('edit.keyword');
Route::post('/addcomment', [ClientsProfile::class, 'addComment'])->name('addcomment');

//report download 
Route::get('/downloadmediauniverse',[ClientsProfile::class,'downloadMediaUniverseReport'])->name('downloadmediauniverse');

Route::get('/webuniverse',[WebUniverse::class,'index'])->name('webuniverse');
Route::get('/webuniverse/{id}',[WebUniverse::class,'view'])->name('webuniverse.view');
Route::post('/webuniverse/store', [WebUniverse::class, 'store'])->name('webuniverse.store');
Route::post('/rssfeed', [WebUniverse::class, 'store'])->name('rssfeed.store');



Route::get('/test',function(){
    return Picklist::where('type','keyword category')->orderBy('name')->get();
});

});

