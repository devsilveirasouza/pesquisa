<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['titulo'];

    public function questions()
    {   // Têm muitas
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
    
}
