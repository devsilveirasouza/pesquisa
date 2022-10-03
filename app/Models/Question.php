<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable     =   ['titulo', 'obrigatoria', 'tipo', 'user_id'];
    // Uma questão pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Uma Questão pertence a muitas opções
    public function options()
    {
        return $this->belongsToMany(Option::class)->withTimestamps();
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'answers', 'question_id')->withTimestamps();
    }
}
