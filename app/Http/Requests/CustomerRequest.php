<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|unique:customers,username'.$this->id,
            'email' => 'required|unique:customers,email'.$this->id,
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password|min:6'
        ];
    }
}
