<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

        protected $table = 'questions';

        protected $dates = ['deleted_at'];

        public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
