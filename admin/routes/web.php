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




Route::get('/', 'HomeController@HomeIndex');
Route::get('/visitor', 'VisitorController@VisitorIndex');
Route::get('/services', 'ServicesController@ServiceIndex');
Route::get('/Courses', 'CourseController@CourseIndex');



//service route portion
Route::get('/getServicesData', 'ServicesController@getServicesData');
Route::post('/ServiceDelete', 'ServicesController@serviceDelete');
Route::post('/serviceUpdate', 'ServicesController@ServiceUpdate');
Route::post('/updatefinal', 'ServicesController@updateFinal');
Route::post('/addfinal', 'ServicesController@addFinal');

//home route portion
Route::get('/getHomeWorkData', 'HomeController@getHomeWorkData');
Route::post('/homeDelete', 'HomeController@homeDelete');
Route::post('/homeUpdate', 'HomeController@homeUpdate');
Route::post('/homeUpdateFinal', 'HomeController@homeUpdateFinal');


//courses route portion
Route::get('/getCoursesData', 'CourseController@getCoursesData');
Route::post('/CourseDelete', 'CourseController@CourseDelete');
Route::post('/CourseDeatails', 'CourseController@CourseDeatails');
Route::post('/Courseupdate', 'CourseController@Courseupdate');
Route::post('/CourseaddFinal', 'CourseController@CourseaddFinal');
