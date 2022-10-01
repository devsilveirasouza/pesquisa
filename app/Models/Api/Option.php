<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';

    protected $fillable = 'titulo';

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps(); // option_id
    }

}
