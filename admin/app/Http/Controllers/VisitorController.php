<?php

namespace App\Http\Controllers;
use App\VisitorModel;

use Illuminate\Http\Request;

class VisitorController extends Controller
{
    function VisitorIndex(){

        $VisitorData=json_decode(VisitorModel::orderBY('id','desc')->get());
           
            return view('Visitor',['VisitorData'=> $VisitorData]);
        }
}
