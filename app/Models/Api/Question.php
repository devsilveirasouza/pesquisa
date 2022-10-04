<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Question extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'titulo','obrigatoria','tipo','user_id'
    ];
     public function user()
     {
        return $this->belongsTo(User::class);
     }
     public function options()
     {
        return $this->belongsToMany(Option::class)->withTimestamps();
     }
     public function answers()
     {
        return $this->belongsToMany(Answer::class)->withTimestamps();
     }
}
