<?php

namespace App\Http\Requests;

use App\Models\FormField;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateFormFieldRequest extends FormRequest
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
        return FormField::$rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return FormField::$messages;
    }
}
