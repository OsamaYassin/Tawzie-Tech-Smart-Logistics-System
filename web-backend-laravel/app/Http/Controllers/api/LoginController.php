<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\DistributerInfo;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    //





    public  function  d(){
       $dd= Admin::selection()->get();

       /* $dd = DB::table('distributer_info')
            ->select('id', 'name', 'phone', 'username')
            ->get();*/

        return $dd;
        return "hel1111low";
    }
}
