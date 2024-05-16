<?php

namespace App\Http\Controllers;

use App\Models\Clientkeyword;
use Illuminate\Http\Request;
use App\Models\Keywordmaster;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KeywordController extends Controller
{
    public function keywordlist()
    {
        $keyword = request('keyword');

        $results = Keywordmaster::where('keyword', 'like', '%' . $keyword . '%')
        ->whereRaw("IFNULL(filter_string, '') = ''")
        ->limit(10)->get();

        return response()->json($results);
    }
    public function filterstrings(){
        $keyword = request('keyword');

        $results = Keywordmaster::where('keyword', $keyword)
            ->whereNotNull('filter_string')
            ->where('filter_string', '<>', '')
            ->get();

        return response()->json($results);
    }
    public function saveKeyword(Request $request)
    {
     
        $request->validate([
            'keyword'=>'required',
            'filterString' => 'required',
            'category'=>'required',
            'type'=>'required',
            'companyString'=>'required',
            'brandString'=>'required'
        ]);
        try {
        DB::beginTransaction();
        $keywordData = [
            'KeyWord' => $request->input('keyword'),
            'Filter' => '',
            'Filter_String' => $request->input('filterString'),
            'EditDateTime'=>now()
        ];

        $keyword = $request->input('keyword');

        $keywordRecord = Keywordmaster::updateOrCreate(
            ['KeyWord' => $keyword, 'Filter_String' => $request->input('filterString')],
            $keywordData
        );
        if ($keywordRecord->wasRecentlyCreated) {
            $parentKeyword = Keywordmaster::where(['KeyWord' => $keyword, 'PrimaryKeyID' => 0])->first();
            if ($parentKeyword) {
                $keywordRecord->update(['PrimaryKeyID' => $parentKeyword->keyID]);
            }
            $message = ['message' => 'Keyword created successfully'];
        } else {
            $message = ['message' => 'Keyword updated successfully'];
        }
        Clientkeyword::updateOrCreate([
            'ClientID'=> base64_decode(request('clientid')),'KeywordID'=> $keywordRecord->keyID
        ],[
            'ClientID'=> base64_decode(request('clientid')),
            'KeywordID'=> $keywordRecord->keyID,
            'Category'=>$request->input('category'),
            'Type'=> $request->input('type'),
            'Filter'=> $request->input('filter')??'',
            'CompanyS'=>$request->input('companyString'),
            'BrandS'=>$request->input('brandString'),
            'EditDateTime'=>now()
        ]);
        DB::commit();
        session()->flash('success', $message['message']);
        Log::info('keyword Name: {name} and keyid: {keyid} by user: {user} ',['keyid'=>$keywordRecord->keyID,'user'=>auth()->user()->UserID,'name'=>$keyword]);
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('error', 'Operation Failed!');
        Log::error('Error while updating client contact: {error}', ['error' => $e->getMessage()]);
        return response()->json(['message' => $e->getMessage()], 500);
    }
    }
}

