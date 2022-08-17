<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates                = ['deleted_at'];

    protected $table                = "options";

    protected $primaryKey           = "id";

    protected $fillable             = ['id_pergunta'];

    protected $casts                = [
        'opcaoResposta'             => 'array'
    ];

    public function question()
    {
        return $this->belongsToMany('App\Models\Question');
    }
}
