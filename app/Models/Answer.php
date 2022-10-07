<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'question_id', 'option_id', 'comment', 'user_id'
    ];

    protected $casts = ['option_id'];

    // DataFilter -> filtra os dados pela data
    public function scopeDateFilter( $query, $from_date = null, $to_date = null )
    {
        if (!empty( $from_date )) {
            $from_date = date("Y-m-d 00:00:01", strtotime( $from_date ));
            $to_date = (!empty( $to_date)) ? date("Y-m-d 23:59:59", strtotime( $from_date )) : date("Y-m-d 23:59:59", strtotime( $to_date ));

            $query->whereBetween('created_at', [ $from_date, $to_date]);
        }
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    public function options()
    {
        return $this->belongsToMany(Option::class)->withTimestamps();
    }
    // Uma questão pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
