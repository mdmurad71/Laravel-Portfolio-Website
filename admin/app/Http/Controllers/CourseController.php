<?php

namespace App\Http\Controllers;
use App\CoursesModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function CourseIndex(){

        return view('Courses');
    }

    function getCoursesData(){

    $result=json_encode(CoursesModel::all());
    return $result;
}

function CourseDelete(Request $req){

    $id= $req->input('id');
    $result=CoursesModel::where('id', '=', $id)->delete();
    if($result==true){
        return 1;
    }else{
        return 0;
    }
 
 }

 function CourseDeatails(Request $req){

    $id= $req->input('id');
    $result=json_encode(CoursesModel::where('id', '=', $id)->get());
    return $result;
 }


 function Courseupdate(Request $req){
    $id=$req->input('id');
    $course_name =$req->input('course_name ');
    $course_desc=$req->input('course_desc');
    $course_fee=$req->input('course_fee');
    $course_totalenroll=$req->input('course_totalenroll');
    $course_totalclass=$req->input('course_totalclass');
    $course_link=$req->input('course_link');
    $course_image=$req->input('course_image');
    $result=CoursesModel::where('id', '=', $id)->update([
        'course_name'=>$course_name,
        'course_desc'=>$course_desc,
        'course_fee'=>$course_fee,
        'course_totalenroll'=>$course_totalenroll,
        'course_totalclass'=>$course_totalclass,
        'course_link'=>$course_link,
        'course_image'=>$course_image
        ]);
    if($result==true){
        return 1;
    }else{
        return 0;
    }
}


function CourseaddFinal(Request $req){
    $id=$req->input('id');
    $course_name =$req->input('course_name ');
    $course_desc=$req->input('course_desc');
    $course_fee=$req->input('course_fee');
    $course_totalenroll=$req->input('course_totalenroll');
    $course_totalclass=$req->input('course_totalclass');
    $course_link=$req->input('course_link');
    $course_image=$req->input('course_image');
    $result=CoursesModel::insert([
        'course_name'=>$course_name,
        'course_desc'=>$course_desc,
        'course_fee'=>$course_fee,
        'course_totalenroll'=>$course_totalenroll,
        'course_totalclass'=>$course_totalclass,
        'course_link'=>$course_link,
        'course_image'=>$course_image
        ]);
    if($result==true){
        return 1;
    }else{
        return 0;
    }

}



}
