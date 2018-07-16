<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'preview' => 'required|min:3',
            'body' => 'required|min:3',
            'cover' => 'sometimes|mimes:jpeg,bmp,png',
        ];
    }
}
