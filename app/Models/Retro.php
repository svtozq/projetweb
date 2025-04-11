<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retro extends Model
{
    protected $table        = 'retros';
    protected $fillable     = ['retro_id', 'cohort_id', 'commentary'];
}
