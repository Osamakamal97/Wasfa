<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Recipe;
use App\User;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::get()->count();
        $recipes = Recipe::get()->count();
        $news = News::get()->count();
        $users = User::get()->count();
        return view('admin.dashboard')->with([
            'categories' => $categories,
            'recipes' => $recipes,
            'news' => $news,
            'users' => $users,
        ]);
    }

    public function test()
    {
        return view('test');
    }
    public function test2()
    {
        return view('test2');
    }
}
