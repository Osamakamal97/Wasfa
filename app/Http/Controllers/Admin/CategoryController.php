<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategory;
use App\Http\Requests\Admin\UpdateCategory;
use App\Models\Category;
use App\Traits\APITrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    use APITrait;

    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index', compact('categories'));
    }

    public function store(StoreCategory $request)
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

    public function update(UpdateCategory $request)
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
            try {
                $category->delete();
                return response()->json([
                    'status' => true,
                    'msg' => 'Category ' . $category_name . ' deleted successfully.',
                    'id' => $request->id
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Category has foreign key by recipes Not deleted.',
                ]);
            }
        } else
            return response()->json([
                'status' => false,
                'msg' => 'Category Not deleted.',
            ]);
    }
}
