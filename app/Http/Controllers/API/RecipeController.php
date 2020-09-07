<?php

namespace App\Http\Controllers\API;

use App\Events\LikeEvent;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Like;
use App\Models\Recipe;
use App\Traits\APITrait;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
    use APITrait;

    public function getRecipeById(Request $request)
    {
        $id = $request->recipe_id;
        try {
            $recipe = Recipe::find($id);
            if (!$recipe) {
                return $this->returnError('S000', 'Recipe not found');
            }
            return $this->returnData('recipe', $recipe, 'This is recipe by id.');
        } catch (Exception $e) {
            return $this->returnError('S000', 'Recipe not found');
        }
    }

    public function getRecipeComments(Request $request)
    {
        $recipe_id = $request->recipe_id;
        try {
            $comments = Recipe::find($recipe_id)->comments;
            $comments->each(function ($comment, $key) {
                return $comment->user;
            });
            if (!$comments) {
                return $this->returnError('S000', 'comments not found');
            }
            return $this->returnData('comments', $comments, 'This is comments for recipe.');
        } catch (Exception $e) {
            return $this->returnError('S000', 'comments not found');
        }
    }

    public function addNewRecipe(Request $request)
    {

        try {
            // ! Validation
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required'],
                    'content' => ['required'],
                    'image' => ['required'],
                    'components' => ['required', 'array'],
                    'category_id' => ['required'],

                ]
            );
            // Check if there is any validation errors ro return it
            if ($validator->fails()) {
                return $this->returnValidationError('E001', $validator);
            }
            // ? Register recipe
            $recipe = $request->all();
            Recipe::create($recipe);
            // * return success
            return $this->returnSuccess('recipe created successfully', 'S005');
        } catch (Exception $e) {
            return $this->returnError('S001', 'Problem: ' . $e);
        }
    }
    // Like/Dislike section

    public function like(Request $request)
    {
        // ! user should be login and just can do one like
        try {
            $recipe_id = $request->recipe_id;
            $user_id = Auth::id();
            $like = Like::where('recipe_id', $recipe_id)->where('user_id', $user_id);
            if ($like->first()) {
                return $this->returnError('E001', 'Recipe is already liked.');
            }
            Like::create(['recipe_id' => $recipe_id, 'user_id' => $user_id]);
            return $this->returnSuccess('S000', 'Recipe like successfully.');
        } catch (Exception $e) {
            return $this->returnError('S001', 'Problem: ' . $e);
        }
    }

    public function dislike(Request $request)
    {
        // ! user should be login and just can do one dislike
        try {
            $recipe_id = $request->recipe_id;
            $user_id = Auth::id();
            $like = Like::where('recipe_id', $recipe_id)->where('user_id', $user_id);
            if (!$like->first()) {
                return $this->returnError('E001', 'Recipe not found.');
            }
            $like->delete();
            return $this->returnSuccess('S000', 'Recipe dislike.');
        } catch (Exception $e) {
            return $this->returnError('S001', 'Problem: ' . $e);
        }
    }

    // Favorite section

    public function getFavoritesForUser()
    {
        $user_id = Auth::id();
        try {
            $favorites = User::find($user_id)->getFavoriteRecipes();
            if (!$favorites) {
                return $this->returnError('E001', 'Favorites not found.');
            }
            return $this->returnData('favorites', $favorites, 'This is favorite recipes for user.');
        } catch (Exception $e) {
            return $this->returnError('E001', 'Error get favorites');
        }
    }

    public function addToFavorite(Request $request)
    {
        $user_id = Auth::id();
        $recipe_id = $request->recipe_id;
        try {
            $favorites = Favorite::where('user_id', $user_id)->where('recipe_id', $recipe_id)->first();
            if ($favorites != null) {
                return $this->returnError('E001', 'This recipe in favorites already.');
            }
            Favorite::create(['user_id' => $user_id, 'recipe_id' => $recipe_id]);
            return $this->returnSuccess('E001', 'Recipe add to favorites successfully.');
        } catch (Exception $e) {
            return $this->returnError('E001', 'Error get favorites');
        }
    }

    public function removeFromFavorite(Request $request)
    {
        $user_id = Auth::id();
        $recipe_id = $request->recipe_id;
        try {
            $favorites = Favorite::where('user_id', $user_id)->where('recipe_id', $recipe_id)->first();
            if ($favorites == null) {
                return $this->returnError('E001', 'This recipe in not in your favorite.');
            }
            $favorites->delete();
            return $this->returnSuccess('E001', 'Recipe remove from favorites successfully.');
        } catch (Exception $e) {
            return $this->returnError('E001', 'Error get favorites');
        }
    }

    public function search(Request $request)
    {
        $search_content = $request->search_content;
        // $recipes = Recipe::where('title', 'LIKE', "%{$search_content}%")->get();
        $recipes = Recipe::whereLike(['title', 'content'], "%{$search_content}%")->get();
        if (!$recipes) {
            return $this->returnError('E000', 'Not found');
        }

        return $this->returnData('recipes', $recipes, 'This is recipes like what you search about.');
    }
}
