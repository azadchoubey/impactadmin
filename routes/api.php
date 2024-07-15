<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientsProfile;
use App\Http\Controllers\FilterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(KeywordController::class)->group(function () {
    Route::get('/keywordlist', 'keywordlist')->name('keywords.list');
    Route::get('/filter-strings', 'filterstrings')->name('keywords.filterstrings');
    Route::get('/keywordClients', 'keywordClients')->name('keywords.clients');
    Route::get('/companystring','companyString')->name('companyString');
    Route::get('/brandString','brandString')->name('brandString');
});
Route::post('/searchexceptional',[ClientsProfile::class,'searchExceptional'])->name('searchexceptional');
Route::post('/filter',[FilterController::class,'filter'])->name('filter');
Route::post('/saveselecteddata',[FilterController::class,'saveselecteddata'])->name('saveselecteddata');
Route::delete('deleteClient', [ClientsProfile::class, 'deleteClient'])->name('delete.client');