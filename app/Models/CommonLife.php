<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonLife extends Model
{
    protected $table        = 'common_life';
    protected $fillable     = ['task', 'description', 'commentary', 'status'];
}
