<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSchoolRequest extends FormRequest
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
//            'company_name' => 'required',
//            'phone' => 'required',
//            'addres' => 'required',
            //'domain' => 'required|unique:schools',
            //'director' => 'required',

            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ];
    }
}
