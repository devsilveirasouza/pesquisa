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

    protected $fillable             = ['titulo'];

    // Uma opção pertence a muitas questões
    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
    // Uma opção pertence a muitas perguntas
    public function perguntas()
    {
        return $this->belongsToMany(Question::class, 'pergunta_resposta', 'option_id')->withTimestamps();
    }
}
