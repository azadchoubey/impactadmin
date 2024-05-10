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
}
