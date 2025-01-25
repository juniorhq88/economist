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
}
