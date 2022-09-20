<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesquisa extends Model
{
    use HasFactory;

    protected $fillable = [
        'questionnaire','questions','options'
    ];

    protected $casts = [
        'questions' =>  'array',
        'options'   =>  'array'
    ];


    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)->withTimestamps();
    }

    public function questions()
    {
        return $this->belongsToMany(Questions::class)->withTimestamps();
    }

}
