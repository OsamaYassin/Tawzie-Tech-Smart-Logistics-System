<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SalesPoints;

use App\Models\Products;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;

class DistributerPointController extends Controller
{
    //
    use  GeneralTraits;


    public  function  DashboardData(){

    }


    public  function  DisplayData(){

        $distributionPoint = SalesPoints::selection()->get();

        return $this-> returnData('distributionPoint' ,$distributionPoint);
    }


    public  function  saveData(Request $request){

        $distributionPoint = SalesPoints::create([
            'id' => $request -> point_id,
            'point_name' => $request->point_name,
            'phone' => $request->phone,
            'type' => $request->type,
            'area' => $request->area,
            'note' => $request->note,
            "distribut_id"=> $request->distribut_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if($distributionPoint->count() > 0) {
            $getAllPointCount = SalesPoints::where(
                ['distribut_id' => $request->distribut_id])->selection()->get()->count();

            $getYesVisitPointCount = SalesPoints::where(
                ['distribut_id' => $request->distribut_id, 'visit' => 'yes'])->selection()->get()->count();

            return $this->returnDataPointCount('distributionPoint',$distributionPoint, $getAllPointCount, $getYesVisitPointCount);


      //  return $this-> returnData('distributionPoint' ,$distributionPoint);

        }

        //return $this-> returnData('distributionPoint' ,$distributionPoint);
    }




    public  function  ProductPrice(Request $request){

        $productPrice =Products::selection()->get();

        if($productPrice->count() == 0)
            return $this->returnErrors('001', 'Not Found');


        return $this-> returnData('productPrice' ,$productPrice);
    }

    public  function  DisplayDistributorPoint(Request $request){

        $distributionPoint = SalesPoints::where(
            ['distribut_id' => $request->distribut_id, 'active' => 1,])->selection()->get();

        if($distributionPoint->count() == 0)
            return $this->returnErrors('001', 'Not Found');


        return $this-> returnData('distributionPoint' ,$distributionPoint);
    }


    public  function  DeActiveDistributorPoint(Request $request){

        $deactive = SalesPoints::where( 'point_id'  , $request ->  point_id  )
        ->update([
            'active' => 0
        ]);

        $distributionPoint = SalesPoints::where(
            [ 'point_id'  => $request ->  point_id])->selection()->get();


    return $this-> returnData('distributionPoint' ,$distributionPoint);
    }




    public  function  DistributerUpdateNo(Request $request){
        $distributionPoint = SalesPoints::where(  'distribut_id'  , $request ->  distribut_id  )
            ->update([
                'visit' => 'no'
            ]);

        return $this-> returnData('distributionPoint' ,$distributionPoint);
    }

    public function  getCountPointAndCountVisitDashboard(Request $request){

        $getAllPointCount = SalesPoints::where(
            ['distribut_id' => $request->distribut_id])->selection()->get()->count();

        $getYesVisitPointCount = SalesPoints::where(
            ['distribut_id' => $request->distribut_id, 'visit' => 'yes'])->selection()->get()->count();

        return $this->returnDataPointCountDashboard( $getAllPointCount, $getYesVisitPointCount);

    }

}


