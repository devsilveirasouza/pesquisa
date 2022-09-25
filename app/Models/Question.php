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

    protected $fillable     =   [

        'titulo', 'obrigatoria', 'tipo', 'user_id'
    ];

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
    // Uma questão pertence a muitos questionários
    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)->withTimestamps();
    }
    // Uma questão têm muitos comentários
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // Uma questão pertence a muitas respostas
    public function respostas()
    {
        return $this->belongsToMany(Option::class, 'pergunta_resposta', 'question_id')->withTimestamps();
    }
    // Uma questão pertence a muitos questionários
    public function pesquisas()
    {
        return $this->belongsToMany(Pesquisa::class)->withTimestamps();
    }
}
