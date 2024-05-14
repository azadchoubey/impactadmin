<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keywordmaster;
use Illuminate\Cache\RateLimiting\Limit;

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
        $keywordData = [
            'KeyWord' => $request->input('keyword'),
            'filter' => $request->input('filter'),
            'filter_string' => $request->input('filterString'),
            'type' => $request->input('type'),
            'category' => $request->input('category'),
            'company_string' => $request->input('companyString'),
            'brand_string' => $request->input('brandString'),
            'EditDateTime'=>now()
        ];

        $keyword = $request->input('keyword');

        if(Keywordmaster::where(['keyword' => $keyword,'filter_string'=>$request->input('filterString')])->update($keywordData)){
            
        }

        $keywordRecord = Keywordmaster::updateOrCreate(
            ['keyword' => $keyword,'filter_string'=>$request->input('filterString')],
            $keywordData
        );

        if ($keywordRecord->wasRecentlyCreated) {
            return response()->json(['message' => 'Keyword created successfully', 'keyword' => $keywordRecord->KeyWord]);
        } else {
            return response()->json(['message' => 'Keyword updated successfully', 'keyword' => $keywordRecord]);
        }
    }
}

