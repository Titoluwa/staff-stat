<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');

Route::get('/gender', 'DataViewController@gender_data');
Route::post('/check_gender', 'DataViewController@check_gender');


Route::get('/marital', 'DataViewController@marital_data');
Route::post('/check_marital', 'DataViewController@check_marital');

Route::get('/dept', 'DataViewController@dept_data');
Route::post('/check_dept', 'DataViewController@check_dept');


Route::get('/branch', 'DataViewController@location_data');
Route::post('/check_branch', 'DataViewController@check_location');

Route::get('/position', 'DataViewController@position_data');
Route::post('/check_position', 'DataViewController@check_position');

Route::get('/age', 'DataViewController@age_data');
Route::post('/check_age', 'DataViewController@check_age');

Route::get('/employment_date', 'DataViewController@employment_date');
Route::get('/check_year/{year}', 'DataViewController@emp_year');

Route::get('/salary','DataViewController@salary_data');

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/show', function () {
//     return view('layouts.app');
// });
// Route::get('/data', 'DataViewController@get_data');