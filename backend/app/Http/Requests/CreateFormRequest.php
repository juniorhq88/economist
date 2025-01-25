<?php

namespace App\Http\Requests;

use App\Models\Form;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
        return Form::$rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return Form::$messages;
    }
}
