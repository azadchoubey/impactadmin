<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientsProfile;
use App\Http\Controllers\ClientWebUniverse;
use App\Http\Controllers\FilterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\WebUniverse;

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

Route::controller(ClientsProfile::class)->group(function () {
    Route::post('/saveOption','saveOption')->name('saveOption');
    Route::post('/renameconcept','renameconcept')->name('renameconcept');
    Route::post('/renameconceptprint','renameconceptprint')->name('renameconceptprint');
    Route::post('/searchexceptional','searchExceptional')->name('searchexceptional');
    Route::post('/displayKeywords','displayKeywords')->name('displayKeywords');
    Route::post('/displayKeywordsPrint','displayKeywordsPrint')->name('displayKeywordsPrint');
    Route::delete('deleteClient','deleteClient')->name('delete.client');
    Route::get('/getclientconcepts',  'getClientConcepts')->name('getclientconcepts');
    Route::get('/getprintclientconcepts',  'getprintclientconcepts')->name('getprintclientconcepts');
    Route::post('/add-complex-concepts',  'addComplexConcepts')->name('add-complex-concepts');
    Route::post('/add-print-complex-concepts',  'addPrintComplexConcepts')->name('addPrintComplexConcepts');
    Route::post('/update-complex-concepts',  'updateComplexConcepts')->name('updateComplexConcepts');
    Route::post('/update-print-complex-concepts',  'updatePrintComplexConcepts')->name('updatePrintComplexConcepts');
    Route::delete('/deleteConcept',  'deleteConcept')->name('deleteConcept');
    Route::delete('/deletePrintConcept',  'deletePrintConcept')->name('deletePrintConcept');
    Route::post('/saveissue',  'saveIssue')->name('save.issue');
    Route::post('/saveprintissue',  'savePrintIssue')->name('save.print.issue');
    Route::get('/issues/{issueId}/edit',  'editIssue')->name('editIssue');
    Route::get('/issuesprint/{issueId}/edit',  'editPrintIssue')->name('editPrintIssue');
    Route::delete('/delete-issue/{id}',  'deleteIssue')->name('deleteIssue');
    Route::delete('/delete-issue-print/{id}',  'deletePrintIssue')->name('deletePrintIssue');
    Route::post('/enableDisableIssue/{id}',  'enableDisableIssue')->name('enableDisableIssue');
    Route::post('/enableDisableIssuePrint/{id}',  'enableDisableIssuePrint')->name('enableDisableIssuePrint');
    Route::post('/addConceptPrint',  'addConceptPrint')->name('addConceptPrint');
    Route::post('/storeissue',  'storeIssue')->name('storeIssue');
    Route::post('/rssnames',  'rssnames')->name('rssnames');
    Route::post('/deleterssnames',  'getSelectedRssFeeds')->name('getSelectedRssFeeds');
    
});

Route::controller(ClientWebUniverse::class)->group(function () {
    Route::get('/getCountries', 'getCountries')->name('getCountries');
    Route::get('/getCategories', 'getCategories')->name('getCategories');
    Route::get('/getIndustory','getIndustory')->name('getIndustory');
    Route::get('/getFocus','getFocus')->name('getFocus');
    Route::get('/getMedia','getMedia')->name('getMedia');
    Route::get('/getAudience','getAudience')->name('getAudience');
    Route::get('/getAudienceAge','getAudienceAge')->name('getAudienceAge');
    Route::get('/getRegional','getRegional')->name('getRegional');
    Route::post('/saverssRegenerate','saverssRegenerate')->name('saverssRegenerate');
});

Route::get('webuniverse/fetch', [WebUniverse::class, 'fetchWebUniverse'])->name('webuniverse.fetch');


Route::post('/filter',[FilterController::class,'filter'])->name('filter');
Route::post('/saveselecteddata',[FilterController::class,'saveselecteddata'])->name('saveselecteddata');
