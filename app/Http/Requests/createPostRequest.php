<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createPostRequest extends FormRequest
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
            'name' => 'required|string',
            'desc' => 'required|string',
            'pictures' => 'mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
