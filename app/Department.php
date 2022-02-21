<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table   = 'tblDepartment';
    protected $guarded = ['DepartmentRef'];
    public $primaryKey = 'DepartmentRef';
    public $timestamps = true;

}
