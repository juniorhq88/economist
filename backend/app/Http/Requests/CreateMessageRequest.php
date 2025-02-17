<?php

namespace App\Http\Requests;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
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
        return Message::$rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return Message::$messages;
    }
}
