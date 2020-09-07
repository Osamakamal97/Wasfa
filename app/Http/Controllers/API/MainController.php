<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Recipe;
use App\Models\Slider;
use App\Traits\APITrait;
use Exception;
use Illuminate\Http\Request;

class MainController extends Controller
{
    use APITrait;

    public function getMainScreenData(Request $request)
    {
        try {
            // Sliders
            $sliders = Slider::where('status', 1)->select('title', 'image')->get();
            // News 
            $news = News::get()->random(4);
            // Recipes
            $recipes = Recipe::get()->random(4);
            // return
            $data = [
                'sliders' => $sliders,
                'news' => $news,
                'recipes' => $recipes
            ];
            return $this->returnData('data', $data, 'This is main page data.');
        } catch (Exception $e) {
            return $this->returnError('S000', 'Fail to get Data, please try again.');
        }
    }
}
