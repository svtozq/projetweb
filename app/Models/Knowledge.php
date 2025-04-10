<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    protected $table        = 'knowledge';
    protected $fillable     = ['student_id', 'skill', 'description', 'status'];
}
