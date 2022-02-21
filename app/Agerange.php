<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agerange extends Model
{
    protected $table   = 'age_range';
    protected $guarded = ['id'];
    public $primaryKey = 'id';
}
