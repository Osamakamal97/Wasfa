<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRecipe;
use App\Http\Requests\Admin\UpdateRecipe;
use App\Models\Category;
use App\Models\Recipe;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class RecipeController extends Controller
{

    use APITrait;

    public function index()
    {
        $recipes = Recipe::get();
        return view('admin.recipe.index', compact('recipes'))->with(['title' => 'Recipes']);
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.recipe.create', [
            'categories' => $categories
        ]);
    }

    public function store(StoreRecipe $recipe)
    {
        Recipe::create($recipe->all());
        return $this->returnSuccess('S000', 'Recipe created successfully.');
    }

    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $categories = $this->getCategories();
        if ($recipe) {
            return view('admin.recipe.edit', [
                'recipe' => $recipe,
                'categories' => $categories
            ]);
        } else {
            return view('admin.recipe.index')->with('error', 'Recipe not found');
        }
    }

    public function update(UpdateRecipe $request)
    {
        $recipe = Recipe::find(1);
        if ($recipe) {
            // delete old photo
            File::delete('images/recipes/' . $recipe->image);
            $recipe->update($request->all());
            return $this->returnSuccess('S000', 'Recipe updated successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $recipe = Recipe::find($request->id);
        if ($recipe) {
            // delete foreign keys for likes
            $recipe->likes->each(function ($value, $key) {
                $value->delete();
            });
            // delete all related comments for this recipe
            $recipe->comments->each(function ($value, $key) {
                $value->delete();
            });
            $recipe->favorites->each(function ($value, $key) {
                $value->delete();
            });
            // delete related images
            File::delete('images/recipes/' . $recipe->image);
            // delete recipe after delete all foreign keys
            $recipe->delete();
            return $this->returnSuccess('S000', 'Recipe Deleted successfully.');
        }
        return $this->returnError('S001', 'Recipe not found or can not delete.');
    }

    private function getCategories()
    {
        $categories = Category::get();
        $new_cate = [];
        foreach ($categories as $category) {
            Arr::set($new_cate, $category['id'], $category['name']);
        }
        return $new_cate;
    }
}
