<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollGroup extends Model
{
    protected $table   = 'tblPayrollAdjustmentGroup';
    protected $guarded = ['GroupRef'];
    public $primaryKey = 'GroupRef';
    public $timestamps = true;
}
