<?php

namespace App;

use App\Gender;
use App\Department;
use App\Location;
use App\Position;
use App\MaritalStatus;
use App\PayrollGroup;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table   = 'tblStaff';
    protected $guarded = ['StaffRef'];
    public $primaryKey = 'StaffRef';
    public $timestamps = true;
    
    public function gender()
    {
        return $this->hasOne(Gender::class, 'GenderRef','GenderID');
    }
    public function department()
    {
        return $this->hasOne(Department::class, 'DepartmentRef','DepartmentID');
    }
    public function location()
    {
        return $this->hasOne(Location::class, 'LocationRef','LocationID');
    }
    public function position()
    {
        return $this->hasOne(Position::class, 'PositionRef','PositionID');
    }
    public function maritalstatus()
    {
        return $this->hasOne(MaritalStatus::class, 'MaritalStatusRef','MaritalStatusID');
    }
    public function payroll()
    {
        return $this->hasOne(PayrollGroup::class, 'GroupRef','PayrollGroupID');
    }
}
