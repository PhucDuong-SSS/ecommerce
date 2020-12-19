<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' =>'required|integer',
            'category_id'=> 'required|integer',
            'size'=> 'integer',
            'brand_id' => 'required|integer',
            'selling_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image_one' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'image_two' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'image_three' => 'image|mimes:jpeg,jpg,png,gif|max:10000'
        ];
    }


}
