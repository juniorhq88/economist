<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    /** @use HasFactory<\Database\Factories\FormFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class);
    }

    public static $rules = [
        'user_id' => 'required',
        'title' => 'required',
        'description' => 'sometimes',
    ];

    public static $messages = [
        'user_id.required' => 'User ID is required',
        'title.required' => 'Title is required',
    ];
}
