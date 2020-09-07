<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Traits\APITrait;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use APITrait;

    public function getNewsDetails(Request $request)
    {
        $id = $request->news_id;

        try {
            $news = News::find($id);
            if (!$news) {
                return $this->returnError('E001', 'Details for this news not found.');
            }
            return $this->returnData('news', $news, 'This is news details.');
        } catch (Exception $e) {
            return $this->returnError('E001', 'Error happen while get news details');
        }
    }
}
