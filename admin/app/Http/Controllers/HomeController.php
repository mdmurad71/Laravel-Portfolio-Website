<?php

namespace App\Http\Controllers;

use App\HomeModel;
use App\VisitorModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomeIndex(){

        return view('Home');
    }


function getHomeWorkData(){
 $result=  json_encode(HomeModel::all()) ;
 return $result;
}

function homeDelete(Request $req){
    $id= $req->input('id');
    $result=HomeModel::where('id', '=', $id)->delete();
    if($result==true){
        return 1;
    }else{
        return 0;
    }
}


function homeUpdate(Request $req){
  $id= $req->input('id');
  $result=json_encode(HomeModel::where('id', '=', $id)->get());
  return $result;
}

function homeUpdateFinal(Request $req){
  $id= $req->input('id');
  $no= $req->input('no');
  $name= $req->input('name');
  $roll= $req->input('roll');
  $class= $req->input('class');
  $result=HomeModel::where('id', '=', $id)->update(['no'=>$no, 'name'=>$name, 'roll'=>$roll, 'class'=>$class]);
  if($result==true){
    return 1;
}else{
    return 0;
}

}

 
 

}




