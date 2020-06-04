<?php

namespace App\Http\Controllers;

use App\ContactModel;
use App\CoursesModel;
use App\ProjectsModel;
use App\ReviewModel;
use App\ServicesModel;
use App\VisitorModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomeIndex(){
        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeData=date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIP, 'visit_time'=>$timeData]);

        $ServicesData=json_decode(ServicesModel::all());
        $CourseData=json_decode(CoursesModel::orderBy('id','desc')->limit(6)->get());
        $ProjectsData=json_decode(ProjectsModel::orderBy('id','desc')->limit(10)->get());
        $ReviewData=json_decode(ReviewModel::orderBy('id','desc')->limit(10)->get());



        return view('Home',[
            'ServicesData'=>$ServicesData,
            'CourseData'=>$CourseData,
            'ProjectsData'=>$ProjectsData,
            'ReviewData'=>$ReviewData

        ]);
    }


    function  ContactSend(Request $request){
     $Name =  $request->input('contact_name');
     $Mobile=   $request->input('contact_mobile');
     $Email=   $request->input('contact_email');
     $Message=   $request->input('contact_message');

     $result=ContactModel::insert([
        'contact_name'=>$Name,
         'contact_mobile'=>$Mobile,
         'contact_email'=>$Email,
         'contact_message'=>$Message

     ]);

     if ($result==true){
         return "insert success";
     }else{
         return "insert failed";
     }

    }

}
