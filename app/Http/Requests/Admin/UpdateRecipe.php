<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipe extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', "unique:recipes,title, $this->id"],
            'content' => ['required'],
            'image' => ['sometimes','image'],
            'components' => ['required',],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
