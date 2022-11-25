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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required|min:3',
            'body'=>'required',
            'image'=>'required|image',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'title.required'=>'يرجي ادخال العنوان',
    //         'title.min'=>'ادنى عنوان يحتوي على 3 احرف',
    //         'body.required'=>'يرجى ادخال المحتوى',
    //     ];
    // }
}
