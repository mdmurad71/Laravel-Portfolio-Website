<?php

namespace App\Http\Controllers;

use App\CoursesModel;
use App\ProjectsModel;
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


        return view('Home',[
            'ServicesData'=>$ServicesData,
            'CourseData'=>$CourseData,
            'ProjectsData'=>$ProjectsData

        ]);
    }
}
