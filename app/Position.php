<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table   = 'tblPosition';
    protected $guarded = ['PositionRef'];
    public $primaryKey = 'PositionRef';
    public $timestamps = true;
}
