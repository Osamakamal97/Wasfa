<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Traits\APITrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    use APITrait;

    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        if ($category) {
            return response()->json([
                'status' => true,
                'msg' => 'category create successfully',
                'category' => ['id' => $category->id, 'name' => $request->name]
            ]);
        }
    }

    public function update(CategoryRequest $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            $category->update(['name' => $request->name]);
            return response()->json([
                'status' => true,
                'msg' => 'category updated successfully',
                'category' => ['id' => $category->id, 'name' => $request->name]
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::find($request->id);
        if ($category) {
            $category_name = $category->name;
            $category->recipes->each(function ($recipe) {
                // delete all likes for recipe
                $recipe->likes->each(function ($recipe) {
                    $recipe->delete();
                });
                // delete all related comments for this recipe
                $recipe->comments->each(function ($recipe) {
                    $recipe->delete();
                });
                $recipe->favorites->each(function ($recipe) {
                    $recipe->delete();
                });
                $recipe->delete();
            });
            $category->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Category ' . $category_name . ' deleted successfully.',
                'id' => $request->id
            ]);
        } else
            return response()->json([
                'status' => false,
                'msg' => 'Category Not deleted.',
            ]);
    }
}
