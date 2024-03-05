<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function viewarticle($id){
        $article = Article::with('publication','keywords.clients','keywords.keywordname','articleimage','type','sector','subsector')->where(['ArticleID'=>$id])->first();
        //dd($article);
        return view('viewarticle',compact('article'));
    }
}
