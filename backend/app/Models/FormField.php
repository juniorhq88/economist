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
        'type', // text, textarea, select, radio, checkbox
        'required',
        'order',
        'file_path', // nullable
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public static $rules = [
        'form_id' => 'required',
        'label' => 'required',
        'type' => 'required',
        'required' => 'sometimes',
        'order' => 'sometimes',
        'file_path' => 'sometimes',
    ];

    public static $messages = [
        'form_id.required' => 'Form ID is required',
        'label.required' => 'Label is required',
        'type.required' => 'Type is required',
        'type.in' => 'Type must be one of: text, textarea, email, select, radio, checkbox',
    ];
}
