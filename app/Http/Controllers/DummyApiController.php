<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DummyApi;
class DummyApiController extends Controller
{
    function getData(Request $req) {
         $dummy= new DummyApi;
         $dummy->name= $req->name;
         $dummy->email= $req->email;
         $result= $dummy->save();
        if($result) 
        {
            return "all done";
        } else {
            return "not save";
        }
    }
}
