<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table        = "questions";
    protected $primaryKey   = "id";

    protected $fillable     =   [

        'respObrigatoria',
        'tipoResposta'
    ];

    // protected $dates        = [ 'deleted_at' ];

    // protected $hidden       =  ['deleted_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts        = [
        'respObrigatoria'   => 'array',
        'tipoResposta'      => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
