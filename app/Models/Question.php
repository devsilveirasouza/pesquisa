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

        'titulo','obrigatoria','tipo','user_id'
    ];

    public function user()
    {   // Pertence á User
        return $this->belongsTo(User::class);
    }

    public function options()
    {   // Têm muitas Options
        return $this->belongsToMany(Option::class)->withTimestamps();
    }

}
