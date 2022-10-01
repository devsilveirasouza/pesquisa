<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable     =   ['titulo', 'obrigatoria', 'tipo', 'user_id'];

    public function options()
    {
        return $this->belongsToMany(Option::class)->withTimestamps(); // question_id
    }
}
