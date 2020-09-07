<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\APITrait;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use APITrait;

    public function getAll()
    {
        try {
            $categories = Category::get();
            if (!$categories) {
                return $this->returnError('S000', 'Categories not found');
            }
            return $this->returnData('categories', $categories, 'All Categories');
        } catch (Exception $e) {
            return $this->returnError('S000', 'Categories not found');
        }
    }

    public function getRecipesByCategoryId(Request $request)
    {
        $category_id = $request->category_id;
        try {
            $recipes = Category::find($category_id)->recipes;
            if (!$recipes) {
                return $this->returnError('S000', 'Recipes not found');
            }
            return $this->returnData('recipes', $recipes, 'Recipes by category id.');
        } catch (Exception $e) {
            return $this->returnError('S000', 'Recipes not found');
        }
    }
}
