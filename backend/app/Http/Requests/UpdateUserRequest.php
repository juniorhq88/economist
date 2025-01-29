<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $rules = User::$rules;
        $id = $this->segment(2);
        $rules['name'] = 'required';
        $rules['email'] = 'required|unique:users,email,'.$id.',id';
        $rules['password'] = 'sometimes';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.regex' => 'Email is not valid',
            'email.unique' => 'Email already exists',
        ];
    }
}
