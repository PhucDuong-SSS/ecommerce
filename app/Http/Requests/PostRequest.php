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
            'post_title_en'=>'required',
            'post_title_vi'=> 'required',
            'category_id'=>'required',
            'details_en' => 'required',
            'details_vi' => 'required',
            'post_image'=> 'image',
        ];
    }
}
