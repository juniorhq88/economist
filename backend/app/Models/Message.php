<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    /** @use HasFactory<\Database\Factories\MessageFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'form_id',
        'user_id',
        'subject',
        'body',
        'file_path', // nullable
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static $rules = [
        'user_id' => 'required',
        'form_id' => 'required',
        'subject' => 'required',
        'body' => 'required',
    ];

    public static $messages = [
        'form_id.required' => 'Form ID is required',
        'user_id.required' => 'User ID is required',
        'subject.required' => 'Subject is required',
        'body.required' => 'Body is required',
    ];
}
