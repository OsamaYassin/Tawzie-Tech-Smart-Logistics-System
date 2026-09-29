<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DistributionPoint;
use App\Models\OrdersDistributor;
use App\Models\SalesDistributorDetail;
use App\Models\Products;
use App\Models\SalesPoints;
use App\Models\OrdersDistributorDetail;
use App\Models\SalesDistributor;
use App\Models\DebtCollection;
use App\Traits\GeneralTraits;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OrderProductController extends Controller
{
    //
    use  GeneralTraits;


    public  function  DisplayData(){
        $distributionPoint = SalesPoints::selection()->get();

        return $this-> returnData('distributionPoint' ,$distributionPoint);
    }


    public  function  OrderProduct(Request $request){


       try{

         $ldate = date('Y-m-d H:i:s');

        $year =date('Y');
        $months=date('m');
        $day=date('d');
        $hour = date('H:i:s');

           // Get The Total price of product
           $sumPrice = 0;
           foreach ($request->productsitems as $items) {

            $sumPrice+=$items['total_price'];

                $orderProduct = OrdersDistributorDetail::
                create([
                    'order_id' => $request->order_id,
                    'sold_amount' => 0,
                    'order_amount' => $items['quantity'],
                    'order_date' => $ldate,
                    "reminder_amount"=> 0,
                    'distributer_id' => $request-> distributer_id,
                    'product_id' =>  $items['product_id'] ,
                    'total_price' => $items['total_price'],
                    ]);


                }//End for


                $orderReport = OrdersDistributor::create([
                    'order_id' => $request->order_id,
                    'distributer_id' => $request-> distributer_id,
                    'total_price' => $sumPrice,
                    'year' => $year,
                    'months' => $months,
                    'day' => $day,
                    'hour' => $hour,
                ]);

                return $this-> returnData('orderReport' ,$orderReport);

        }  catch  (\Exception $e) {
            return $this-> returnData('orderReport' ,$e);

        }

    }

    public  function  SalesProduct(Request $request){

try{

        $ldate = date('Y-m-d H:i:s');

        $year =date('Y');
        $months=date('m');
        $day=date('d');
        $hour = date('H:i:s');

  // Get The Total price of product
           $sumPrice = 0;
      foreach ($request->productsitems as $items) {

        $sumPrice+=$items['total_price'];
       $salesProduct = SalesDistributorDetail::
        create([
            'sales_id' => $request -> sales_id,
            'point_id' =>$request ->  point_id ,
            'product_id' => $items['product_id']  ,
            'distributer_id' => $request->distributer_id,
            'distribution_date' => $ldate,
            'distributed_amount' =>  $items['quantity'],
            'total_price' =>$items['total_price'],

      ]);

    }


        $SalesReport = SalesDistributor::create([
            'sales_id' => $request -> sales_id,
            'point_id' => $request -> point_id,
            'distributer_id' => $request->distributer_id,
            'total_price' => $sumPrice,

            'chash' => $request -> chash,
            'banckk' => $request -> banckk,
            'sheck' => $request -> sheck,
            'agel' => $request -> agel,

            'year' => $year,
            'months' => $months,
            'day' => $day,
            'hour' => $hour,
            'note' => $request -> note,
        ]);

        SalesPoints::where(  'id'  , $request ->  point_id  )
            ->update([
                'visit' => 'yes'
            ]);

        $getYesVisitPointCount = SalesPoints::where(
            ['distribut_id' => $request->distributer_id, 'visit' => 'yes'])->selection()->get()->count();

       return $this-> returnDataWithCountVisit('SalesReport' ,$SalesReport , $getYesVisitPointCount);


    }  catch  (\Exception $e) {
        return $this-> returnData('orderReport' ,$e);

    }


    }




    public  function  SalesProductOldd(Request $request){


        $ldate = date('Y-m-d H:i:s');

        $year =date('Y');
        $months=date('m');
        $day=date('d');
        $hour = date('H:i:s');


        //get Data from product price
        $prices =Products::select('price')->get();


        //get Data from product price
      /*  $size250 =(int) Product::where('size' ,'=', 250)->select('price')->limit(1)->get()[0]['price'];
        $size350 =(int) Product::where('size' ,'=', 350)->select('price')->limit(1)->get()[0]['price'];
        $size400 =(int) Product::where('size' ,'=', 400)->select('price')->limit(1)->get()[0]['price'];
        $size500 =(int) Product::where('size' ,'=', 500)->select('price')->limit(1)->get()[0]['price'];
        $size1000 =(int) Product::where('size' ,'=', 1000)->select('price')->limit(1)->get()[0]['price'];
        */

        $data = [
            //kasbra100
            $request->kasbra50,
            $request->kasbra100,

            //shmar100
            $request->shmar50,
            $request->shmar100,

            //weaka100
            $request->weaka50,
            $request->weaka100,

            //ganzabel100
            $request->ganzabel50,
            $request->ganzabel100,

            // falfal100
            $request->falfal50,
            $request->falfal100,

            // add othoer data

            $request->qurfa100,
            $request->qurfa50,

             $request->quranful50,
            $request->quranful100,

             $request->kari,
            $request->aqashi,

            $request->mindi,
            $request->alkarsabi,

            $request->alburust,
            $request->alsimsam,

        ];

        $productId = [1,2,3,4,5,6, 7,8,9, 10, 11,12,13,14,15,16, 17,18,19, 20 ];

        $setPrice = [
            $prices[0]['price'],$prices[1]['price'],$prices[2]['price'],$prices[3]['price'],
            //
            $prices[4]['price'],$prices[5]['price'],$prices[6]['price'],$prices[7]['price'],
            //
            $prices[8]['price'],$prices[9]['price'],

            $prices[10]['price'],$prices[11]['price'],$prices[12]['price'],$prices[13]['price'],
            //
            $prices[14]['price'],$prices[15]['price'],$prices[16]['price'],$prices[17]['price'],
            //
            $prices[18]['price'],$prices[19]['price'],

        ];

        // Get The Total price of product
        $sumPrice = 0;

        for ($i = 0; $i < count($data); $i++) {
            if($data[$i]  == 0 || $data[$i] == '' )
                continue;

            $sumPrice +=$setPrice[$i] * (int)$data[$i];
            $salesProduct = SalesDistributorDetail::
            create([
                'sales_id' => $request -> sales_id,
                'point_id' =>$request ->  point_id ,
                'product_id' => $productId[$i] ,
                'distributer_id' => $request->distributer_id,
                'distribution_date' => $ldate,
                'distributed_amount' => $data[$i],
                'total_price' => $setPrice[$i] * (int)$data[$i],

            ]);
        }


        $SalesReport = SalesDistributor::create([
            'sales_id' => $request -> sales_id,
            'point_id' => $request -> point_id,
            'distributer_id' => $request->distributer_id,
            'total_price' => $sumPrice,

            'chash' => $request -> chash,
            'banckk' => $request -> banckk,
            'sheck' => $request -> sheck,
            'agel' => $request -> agel,

            'year' => $year,
            'months' => $months,
            'day' => $day,
            'hour' => $hour,
            'note' => $request -> note,
        ]);

        SalesPoints::where(  'id'  , $request ->  point_id  )
            ->update([
                'visit' => 'yes'
            ]);

        $getYesVisitPointCount = SalesPoints::where(
            ['distribut_id' => $request->distributer_id, 'visit' => 'yes'])->selection()->get()->count();

       return $this-> returnDataWithCountVisit('SalesReport' ,$SalesReport , $getYesVisitPointCount);
       // return $this-> returnData('SalesReport' ,$SalesReport);
    }



    public  function  DisplayDistributorPoint(Request $request){

        $distributionPoint = SalesPoints::where(
            ['distribut_id' => $request->distribut_id,])->selection()->get();

        if($distributionPoint->count() == 0)
            return $this->returnErrors('001', 'Not Found');


        return $this-> returnData('distributionPoint' ,$distributionPoint);
    }

    public  function  DisplaySalesProductOfDistrubuter(Request $request){

        $ShowSalesReport = SalesDistributor::with('distrubute_sales')->where(
            ['distributer_id' => $request->distributer_id,])->orderBy('created_at', 'DESC')->get();

        return $this-> returnData('ShowSalesReport' ,$ShowSalesReport);
    }

    public  function  DisplaySalesProductOfDistrubuterToday(Request $request){

        $ShowSalesReport = SalesDistributor::with('distrubute_sales')->where( [
            'distributer_id' => $request->distributer_id,
            'year' => (int)$request->year,
            'months' => (int)$request->months,
            'day' => (int)$request->day,
            ])->orderBy('created_at', 'DESC')->get();

        return $this-> returnData('ShowSalesReport' ,$ShowSalesReport);
    }


    public  function  DisplayCustomerSalesHistory(Request $request){

        $ShowSalesCustomerReport = SalesDistributor::with('distrubute_sales')->where( [
            'distributer_id' => $request->distributer_id,
            'point_id' => $request->point_id,
            ])->orderBy('created_at', 'DESC')->get();

        return $this-> returnData('ShowSalesCustomerReport' ,$ShowSalesCustomerReport);
    }

    public  function  DisplayCustomersAgel(Request $request){

        $ShowSalesCustomerReport = SalesDistributor::with('distrubute_sales')->where(
            'distributer_id' , $request->distributer_id,
            )->where('agel', '<>' , 0)->orderBy('created_at', 'DESC')->get();

        return $this-> returnData('ShowSalesCustomerReport' ,$ShowSalesCustomerReport);
    }



    public  function  PayDeptSalesUpdate(Request $request){

        $updateDept = SalesDistributor::where( [
            'distributer_id' => $request->distributer_id,
            'point_id' => $request->point_id,
            'sales_id' => $request->sales_id,
            ])-> update([

                'chash' => (int)$request -> chash + (int)$request -> oldchash ,
                'banckk' => (int)$request -> banckk + (int)$request -> oldbanckk,
                'sheck' => (int)$request -> sheck + (int)$request -> oldsheck,
                'agel' => (int)$request -> agel ,
            ]);


            $ldate = date('Y-m-d H:i:s');

            $year =date('Y');
            $months=date('m');
            $day=date('d');
            $hour = date('H:i:s');

        $DebtCollection = DebtCollection::create([
            'sales_id' => $request -> sales_id,
            'point_id' => $request -> point_id,
            'distributer_id' => $request->distributer_id,

            'chash' => (int)$request -> chash,
            'banckk' => (int)$request -> banckk,
            'sheck' => (int)$request -> sheck,
            'agel' => (int)$request -> agel,

            'year' => (int)$year,
            'months' => (int)$months,
            'day' => (int)$day,
            'hour' => (int)$hour,
        ]);


        return $this-> returnData('updateDept' ,$updateDept);
    }

    //





        public  function  TotalWorkToday(Request $request){

            $distributer_id = $request->distributer_id ;
            $year =  $request->year ;
            $months =  $request->months ;
            $day = $request->day ;



               $TotalWorkTodays = DB::table('tw_sales_distributor')
             ->select(DB::raw(' * , SUM(total_price) as s_total_price,  SUM(`chash`) as s_chash ,SUM(`banckk`) as s_banckk, SUM(`sheck`) as s_sheck , SUM(`agel`) as s_agel'))
             ->where(['distributer_id' =>  $distributer_id , 'year' =>  $year , 'months' =>  $months , 'day' =>  $day , ])
             ->get();

              $DebtCollection = DB::table('tw_debt_collection')
             ->select(DB::raw('    SUM(`chash`) as s_chash ,SUM(`banckk`) as s_banckk, SUM(`sheck`) as s_sheck , SUM(`agel`) as s_agel  '))
             ->where(['distributer_id' =>  $distributer_id , 'year' =>  $year , 'months' =>  $months , 'day' =>  $day , ])
             ->get();

              $TotalWorkTodays[0]->created_at = (int)$DebtCollection[0]->s_chash + (int)$DebtCollection[0]->s_banckk  + (int)$DebtCollection[0]->s_sheck;



             $ShowSalesReport = SalesDistributor::where(
                ['distributer_id' => $request->distributer_id,])->orderBy('created_at', 'DESC')->get();

            return $this-> returnData('ShowSalesReport' ,$TotalWorkTodays);
        }


/*
    public  function  OrderDetailDistrbuter(Request $request){


        $orderDetail = OrdersDistributorDetail::with('product_order_detail')->where([
            'order_id' => $request->order_id,
            'distributer_id' => $request->distributer_id,

        ])->selection()->get();



        $test =[];



        for($i = 0 ; $i<  $orderDetail->count(); $i++){
            $test = array(
                'title'  => 'A title',
                'author' => 'An author'
            );
        }

       // 'order_id'  => $orderDetail[$i]->order_id,
       // 'distributer_id' => $orderDetail[$i]->distributer_id,
       // if($distributerInfo->count() == 0)
          //  return $this->returnErrors('001', 'Not Found');

          return $test;
        return $this-> returnData('orderDetail' ,$orderDetail);

    }*/

}
