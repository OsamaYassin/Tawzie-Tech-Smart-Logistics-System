<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;

class DistributerInfoController extends Controller
{
    //
    use  GeneralTraits;


    public  function  DisplayData(){
        $distributerInfo = Distributor::selection()->get();

        return $this-> returnData('distributerIno' ,$distributerInfo);
    }


    public  function  saveData(Request $request){

        $distributerInfo = Distributor::create([
            'id' => $request -> distribut_id,
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => $request->password,
            "vihicle_no"=> $request->vihicle_no,
            'admin_id' => $request->admin_id,
            'area_name' => $request->area_name,
            'active' => 0,
        ]);

        return $this-> returnData('distributerInfo' ,$distributerInfo);
    }

    public  function  CheckLogin(Request $request){

        $distributerInfo = Distributor::where([
            'username' => $request->username,
            'password' => $request->password,
            'active' => 1,
        ])->selection()->get();

        if($distributerInfo->count() == 0)
            return $this->returnErrors('001', 'Not Found');

        return $this-> returnData('distributerInfo' ,$distributerInfo);

    }



}
