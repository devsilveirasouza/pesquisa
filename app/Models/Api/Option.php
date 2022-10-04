<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Option extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['titulo'];

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'answers', 'option_id')->withTimestamps();
    }
}
