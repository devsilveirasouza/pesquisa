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

    public function questions()
    {   // Têm muitas Options
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
}
