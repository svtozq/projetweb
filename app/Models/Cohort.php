<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['id', 'school_id', 'teacher_id', 'name', 'description', 'students', 'start_date', 'end_date'];
}
