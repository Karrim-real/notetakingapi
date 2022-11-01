<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'body'
    ];

    public function messages()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
}
