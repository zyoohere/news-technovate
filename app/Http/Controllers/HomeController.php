<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use App\Models\Media;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
    *
    * @return \Illuminate\Http\Response 
    */
    public function index()
    {
        
        $articles = Article::with(['user'])->get(); 
        $videos = Media::latest()->get();
        $categories = Category::all();
        return Inertia::render('Home', [
            'title' => 'Technovate',
            'articles' => $articles,
            'categories' => $categories,
            'videos'=> $videos,
        ]);

    }
}
