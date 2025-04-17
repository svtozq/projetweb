<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CohortsSchools extends Model
{
    protected $table        = 'cohorts_schools';
    protected $fillable     = ['id', 'cohort_id', 'user_id'];
}
