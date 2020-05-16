<?php

namespace App\Http\Controllers;

use App\ServicesModel;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    function ServiceIndex(){

        return view('Services');
    }

function getServicesData()
{
    $result=json_encode(ServicesModel::all());
    return $result;
}


function serviceDelete(Request $req){

   $id= $req->input('id');
   $result=ServicesModel::where('id', '=', $id)->delete();
   if($result==true){
       return 1;
   }else{
       return 0;
   }

}

function ServiceUpdate(Request $req){

    $id= $req->input('id');
    $result=json_encode(ServicesModel::where('id', '=', $id)->get());
    return $result;
 }

function updateFinal(Request $req){
    $id=$req->input('id');
    $name=$req->input('name');
    $desc=$req->input('desc');
    $image=$req->input('image');
    $result=ServicesModel::where('id', '=', $id)->update(['service_name'=>$name,'service_desc'=>$desc,'service_image'=>$image]);
    if($result==true){
        return 1;
    }else{
        return 0;
    }
}

    function addFinal(Request $req){
        $name=$req->input('name');
        $desc=$req->input('desc');
        $image=$req->input('image');
        $result=ServicesModel::insert(['service_name'=>$name,'service_desc'=>$desc,'service_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    


}



}


