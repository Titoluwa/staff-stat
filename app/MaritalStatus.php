<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $table   = 'tblMaritalStatus';
    protected $guarded = ['MaritalStatusRef'];
    public $primaryKey = 'MaritalStatusRef';
    public $timestamps = true;
}
