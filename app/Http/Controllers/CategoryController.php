<?php

namespace App\Http\Controllers;

use App\Models\Category; // Pastikan model di-import
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
    *
    * @return \Illuminate\Http\Response 
    */
    public function index()
    {
        
        $categories = Category::all();
        return Inertia::render('Home', [
            'title' => 'Technovate',
            'categories' => $categories,
        ]);

    }
}
