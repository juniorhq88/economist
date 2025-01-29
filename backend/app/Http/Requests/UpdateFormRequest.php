<?php

namespace App\Http\Requests;

use App\Models\Form;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
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
        $rules = Form::$rules;
        $rules['description'] = 'sometimes';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return Form::$messages;
    }
}
