<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment'
    ];

    // Um comentário pertence a uma pergunta
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
