<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Answer extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id', 'option_id', 'comment', 'user_id'
    ];

    protected $casts = ['option_id'];

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
    public function options()
    {
        return $this->belongsToMany(Option::class)->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
