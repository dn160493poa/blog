<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'role_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be string',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be string',
            'email.email' => 'Email must be in supporting email formats',
            'email.unique' => 'Email is already exist',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be string',
        ];
    }
}
