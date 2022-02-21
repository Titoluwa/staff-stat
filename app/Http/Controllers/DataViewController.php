<?php

namespace App\Http\Controllers;

use DB;
use App\Staff;
use App\AgeRange;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DataViewController extends Controller
{

    public function gender_data()
    {
        $gender  = Staff::select('GenderID', DB::raw('count(*) as count'))
                ->groupBy('GenderID')->with("gender")
                ->get();
        $gender->transform(function($item){
            if(is_null( $item->GenderID)){
                $item->Gender = 'Not registered';
            }else{
                $item->Gender = $item->gender->Gender;
            }
            return $item;
        });
        $g = $gender->map->only('Gender', 'count');
        $gen = $g->toJson();
        return view('genderdata', compact('gender','gen','g'));
    } 
    public function marital_data()
    {
        $marital  = Staff::select('MaritalStatusID', DB::raw('count(*) as count'))
                    ->groupBy('MaritalStatusID')->with('maritalstatus')
                    ->get();               
        $marital->transform(function($item){
            if(is_null($item->MaritalStatusID)){
                $item->MaritalStatus = 'Not registered';
            }elseif ( $item->MaritalStatusID == 0 ) {
                $item->MaritalStatus = 'Wrong input';
            }
            else{
                $item->MaritalStatus = $item->maritalstatus->MaritalStatus;
            }
            return $item;
        });
        $m = $marital->map->only('MaritalStatus', 'count');
        $mar = $m->toJson();
        return view('maritaldata', compact('marital','mar',));
    }
    public function dept_data()
    {
        // DEPARTMENT 
        $dept = Staff::select('DepartmentID', DB::raw('count(*) as count'))
                        ->groupBy('DepartmentID')->with('department')
                        ->get();
        $dept->transform(function($item){
            if(is_null($item->DepartmentID)){
                $item->Department = 'Not registered';
            }else{
                $item->Department = $item->department->Department;
            }
            return $item;
        });
        $d = $dept->map->only('Department','DepartmentID','count');
        $dep = $d->toJson();
        return view('deptdata', compact('dept','dep',));
    }
    public function location_data()
    {
        // LOCATION
        $location = Staff::select('LocationID', DB::raw('count(*) as count'))
                        ->groupBy('LocationID')->with('location')
                        ->get();
                
        $location->transform(function($item){
            if(is_null( $item->LocationID)){
                $item->Location = 'Not registered';
            }else{
                $item->Location = $item->location->Location;
            }
            return $item;
        });
        $l = $location->map->only('Location', 'count');
        $loc = $l->toJson();
        return view('location', compact('location', 'loc'));
    }
    public function position_data()
    {
        // POSITION
        $position = Staff::select('PositionID', DB::raw('count(*) as count'))
                        ->groupBy('PositionID')->with('position')
                        ->get();
        $position->transform(function($item){
            if(is_null( $item->PositionID)){
                $item->Position = 'No Position';
            }else{
                $item->Position = $item->position->Position;
            }
            return $item;
        });
        $p = $position->map->only('Position', 'count');
        $pos = $p->toJson();
        return view('position', compact('position','pos'));
    }
    public function age_data()
    {
        $age =  Staff::select('Age', DB::raw('count(*) as count'))
            ->groupBy('Age')
            ->get();
        $ageranges =  Staff::select('Age', DB::raw('count(*) as count'))
            ->groupBy('Age')
            ->get();
        $arry30 = array();
        $arry40 = array();
        $arry50 = array();
        $arryabove = array();
        foreach( $age as $a ){
            if (empty($a->Age)){
                $a->Age = "Unregistered";
            }
        }
        // To get the ageranges' count into different array.
        foreach( $ageranges as $a ){
            if(in_array($a->Age, range(1,30)))
            {
                array_push($arry30, $a->count);
            }else if(in_array($a->Age, range(31,40)))
            {
                array_push($arry40, $a->count);
            }else if(in_array($a->Age, range(41,50)))
            {
                array_push($arry50, $a->count);
            } else if(in_array($a->Age, range(51,100)))
            {
                array_push($arryabove, $a->count);
            }
        }
        // To get each ageranges's sum and identify.
        foreach( $ageranges as $a ){
            if (empty($a->Age))
            {
                $a->AgeRange = "Unregistered";
                $a->sum = $a->count;
            }else if(in_array($a->Age, range(0,30)))
            {
                $a->AgeRange = "30 and below";
                $a->sum = array_sum($arry30);
            }else if(in_array($a->Age, range(31,40)))
            {
                $a->AgeRange = "31-40";
                $a->sum = array_sum($arry40);
            }else if(in_array($a->Age, range(41,50)))
            {
                $a->AgeRange = "41-50";
                $a->sum = array_sum($arry50);
            } else if(in_array($a->Age, range(51,100)))
            {
                $a->AgeRange = "50 and above";
                $a->sum = array_sum($arryabove);
            }
        }
        $ages  = $age->map->only('Age', 'count');
        $ager  = $ageranges->map->only('Age','AgeRange' ,'count', 'sum');

        $ages = $ages->toJson();
        $agerange = $ager->toJson();
        return view('agedata', compact('age','ages','agerange','ageranges'));
    }
    public function employment_date()
    {

        $emp_year = Staff::select('EmploymentYear', DB::raw('count(*) as count'))
        ->groupBy('EmploymentYear')->orderBy('EmploymentYear', 'DESC')
        ->get();

        $emp_year->transform(function($item){
            if(is_null( $item->EmploymentYear)){
                $item->EmploymentYear = 'Unregistered';
            }else{
                $item->EmploymentYear = $item->EmploymentYear;
            }
            return $item;
        });
        $e = $emp_year->map->only('EmploymentYear', 'count');
        $emp = $e->toJson();

        return view('employdata', compact('emp_year','emp'));
    }
    public function emp_year($year)
    {
        $emp_date = Staff::select('EmploymentDate', DB::raw('count(*) as count'))->where('EmploymentYear', $year)
        ->groupBy('EmploymentDate')
        ->get();
        $emp_date->transform(function($item){
            if(is_null( $item->EmploymentDate)){
                $item->EmploymentDate = 'Unregistered';
            }else{
                $item->EmploymentDate = Carbon::createFromFormat('Y-m-d',  $item->EmploymentDate)->format('d-M');
            }
            return $item;
        });
        $e = $emp_date->map->only('EmploymentDate', 'count');
        $emp = $e->toJson();

        $data = [
            'emp_date'=>$emp_date,
            'emp'=>$emp,
        ];
        return response()->json($data);
        
    }
    public function salary_data()
    {
        $s_group = Staff::select('PayrollGroupID', DB::raw('count(*) as count'))
                ->groupBy('PayrollGroupID')->with('payroll')->orderBy('PayrollGroupID', 'DESC')
                ->get();
        $s_group->transform(function($item){
            if(is_null( $item->PayrollGroupID)){
                $item->PayrollGroup = 'Not registered';
                $item->pay = 0;
            }elseif ( $item->PayrollGroupID == 0 ) {
                $item->PayrollGroup = 'Wrong input';
                $item->pay = 0;
            }else{
                $item->PayrollGroup = $item->payroll->GroupDescription;
                $item->pay = number_format($item->payroll->GrossPay, 2,".",",");
            }
            return $item;
        });
        $s = $s_group->map->only('PayrollGroup','pay','count');
        $sal = $s->toJson();
        return view('salary', compact('s_group','sal'));
    }
    public function check_gender(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate   = $request->todate;
        $gender  = Staff::select('GenderID', DB::raw('count(*) as count'))
                        ->whereBetween('EntryDate', [$fromdate, $todate])
                        ->groupBy('GenderID')->with("gender")
                        ->get();
        $gender->transform(function($item){
            if(is_null( $item->GenderID)){
                $item->Gender = 'Not registered';
            }else{
                $item->Gender = $item->gender->Gender;
            }
            return $item;
        });
        $g = $gender->map->only('Gender', 'count');
        $gen = $g->toJson();
        $data = [
            'gender'=>$gender,
            'gen'=>$gen,
        ];
        return response()->json($data);
    }
    public function check_location(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate   = $request->todate;
        $location =  Staff::select('LocationID', DB::raw('count(*) as count'))
                        ->whereBetween('EntryDate', [$fromdate, $todate])
                        ->groupBy('LocationID')->with('location')
                        ->get();
        $location->transform(function($item){
            if(is_null( $item->LocationID)){
                $item->Location = 'Not registered';
            }else{
                $item->Location = $item->location->Location;
            }
            return $item;
        });
        $l = $location->map->only('Location', 'count');
        $loc = $l->toJson();
        $data = [
            'location'=>$location,
            'loc'=>$loc,
        ];       
        return response()->json($data);
    }
    public function check_marital(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate   = $request->todate;
        $marital  = Staff::select('MaritalStatusID', DB::raw('count(*) as count'))
                    ->whereBetween('EntryDate', [$fromdate, $todate])
                    ->groupBy('MaritalStatusID')->with('maritalstatus')
                    ->get();               
        $marital->transform(function($item){
            if(is_null($item->MaritalStatusID)){
                $item->MaritalStatus = 'Not registered';
            }elseif ( $item->MaritalStatusID == 0 ) {
                $item->MaritalStatus = 'Wrong input';
            }
            else{
                $item->MaritalStatus = $item->maritalstatus->MaritalStatus;
            }
            return $item;
        });
        $m = $marital->map->only('MaritalStatus', 'count');
        $mar = $m->toJson();
        $data = [
            'marital'=>$marital,
            'mar'=>$mar,
        ];       
        return response()->json($data);
    }
    public function check_position(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate   = $request->todate;
        $position = Staff::select('PositionID', DB::raw('count(*) as count'))
                ->whereBetween('EntryDate', [$fromdate, $todate])
                ->groupBy('PositionID')->with('position')
                ->get();
        $position->transform(function($item){
            if(is_null( $item->PositionID)){
                $item->Position = 'No Position';
            }else{
                $item->Position = $item->position->Position;
            }
            return $item;
        });
        $p = $position->map->only('Position', 'count');
        $pos = $p->toJson();
        $data = [
            'position'=>$position,
            'pos'=>$pos,
        ];       
        return response()->json($data);
    }
    public function check_dept(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate   = $request->todate;
        $dept = Staff::select('DepartmentID', DB::raw('count(*) as count'))
                ->whereBetween('EntryDate', [$fromdate, $todate])
                ->groupBy('DepartmentID')->with('department')
                ->get();
        $dept->transform(function($item){
            if(is_null($item->DepartmentID)){
                $item->Department = 'Not registered';
            }else{
                $item->Department = $item->department->Department;
            }
            return $item;
        });
        $d = $dept->map->only('Department','DepartmentID','count');
        $dep = $d->toJson();
        $data = [
            'dept'=>$dept,
            'dep'=>$dep,
        ];       
        return response()->json($data);
    }
    public function check_age(Request $request)
    {
        $fromdate = $request->fromdate;
        $todate   = $request->todate;
        $age =  Staff::select('Age', DB::raw('count(*) as count'))
                ->whereBetween('EntryDate', [$fromdate, $todate])
                ->groupBy('Age')
                ->get();
        foreach( $age as $a){
            if (empty($a->Age)){
                $a->Age = "Unregistered";
            }
        }
        $ageranges =  Staff::select('Age', DB::raw('count(*) as count'))
                ->whereBetween('EntryDate', [$fromdate, $todate])
                ->groupBy('Age')
                ->get();
        $arry30 = array();
        $arry40 = array();
        $arry50 = array();
        $arryabove = array();
        // To get the ageranges' count into different array.
        foreach( $ageranges as $a ){
            if(in_array($a->Age, range(1,30)))
            {
                array_push($arry30, $a->count);
            }else if(in_array($a->Age, range(31,40)))
            {
                array_push($arry40, $a->count);
            }else if(in_array($a->Age, range(41,50)))
            {
                array_push($arry50, $a->count);
            } else if(in_array($a->Age, range(51,100)))
            {
                array_push($arryabove, $a->count);
            }
        }
        // To get each ageranges's sum and identify.
        foreach( $ageranges as $a ){
            if (empty($a->Age))
            {
                $a->AgeRange = "Unregistered";
                $a->sum = $a->count;
            }else if(in_array($a->Age, range(0,30)))
            {
                $a->AgeRange = "30 and below";
                $a->sum = array_sum($arry30);
            }else if(in_array($a->Age, range(31,40)))
            {
                $a->AgeRange = "31-40";
                $a->sum = array_sum($arry40);
            }else if(in_array($a->Age, range(41,50)))
            {
                $a->AgeRange = "41-50";
                $a->sum = array_sum($arry50);
            } else if(in_array($a->Age, range(51,100)))
            {
                $a->AgeRange = "50 and above";
                $a->sum = array_sum($arryabove);
            }
        }
        $ager  = $ageranges->map->only('Age','AgeRange' ,'count', 'sum');
        $agerange = $ager->toJson();
        $a = $age->map->only('Age', 'count');
        $ag = $a->toJson();
        $data = [
            'age'=>$age,
            'ag'=>$ag,
            'agerange'=> $agerange,
        ];       
        return response()->json($data);
    }
    // AgeRange alternative code
    // $age =  Staff::select('Age', DB::raw('count(*) as count'))
    //         ->groupBy('Age')
    //         ->get();
    //     $range = [
    //         // 'Unregistered' => ['min'=>0,'max'=>0],
    //         '30 and below' => ['min'=>1,'max'=>30],
    //         '31-40'        => ['min'=>31,'max'=>40],
    //         '41-50'        => ['min'=>41,'max'=>50],
    //         '50 and above' => ['min'=>51,'max'=>100],
    //     ];
    //     $ager = [];
    //     foreach($range as $key=>$range){
    //         $ageranges =  Staff::select('Age', DB::raw('count(*) as count'))->whereBetween('Age',[$range['min'],$range['max']])
    //             ->groupBy('Age')
    //             ->get();
            
    //         array_push($ager, (Object) [
    //             'AgeRange' => $key,
    //             'count'    => array_sum($ageranges->map(function($item, $key){
    //                 return $item->count;
    //             })->toArray())
    //         ]); 
    //     }
    //     // dd($ager);
    //     foreach( $age as $a ){
    //         if (empty($a->Age)){
    //             $a->Age = "Unregistered";
    //         }
    //     }
    //     $ages  = $age->map->only('Age', 'count')->toJson();
    //     // $ages = $ages;
    //     $agerange = json_encode($ager);
}
