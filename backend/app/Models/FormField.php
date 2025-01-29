<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    /** @use HasFactory<\Database\Factories\FormFieldFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'form_id',
        'label',
        'type', // text, email, tel, textarea, select, radio, checkbox, file
        'value',
        'required',
        'order',
        'file_path', // nullable
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public static $rules = [
        'fields' => ['required', 'array'],
        'fields.*.form_id' => ['required', 'exists:forms,id'],
        'fields.*.label' => ['required', 'string', 'max:255'],
        'fields.*.type' => ['required', 'string', 'in:text,number,tel,email,textarea'],
        'fields.*.required' => ['required', 'boolean'],
        'fields.*.value' => 'sometimes',
        'fields.*.order' => ['required', 'integer', 'min:1'],
        'fields.*.file_path' => 'sometimes',
    ];

    public static $messages = [
        'form_id.required' => 'Form ID is required',
        'label.required' => 'Label is required',
        'type.required' => 'Type is required',
        'type.in' => 'Type must be one of: text, email, tel, textarea, email, select, radio, checkbox',
    ];
}
