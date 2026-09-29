<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Http\Requests\StoreProducts;
use App\Models\Distributor;
use App\Models\OrdersDistributor;
use App\Models\OrdersDistributorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class  OrdersDistributorController extends Controller
{

    public function index()
    {
        try {

          $OrdersDistributor = OrdersDistributor::with('distrubute_order')->Selection()->get();

            //  $OrdersDistributor[3] -> distrubute_order ;

        return view('pages.distributor.OrderDistributor', compact('OrdersDistributor' ));

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }





    public function ShowDetail($orderID)
    {
        try {


       $OrdersDistributorDetail = OrdersDistributorDetail::with('product_order_detail')->where('order_id', $orderID)->Selection()->get();

       //return $OrdersDistributorDetail[0]-> product_order_detail ;


        return view('pages.distributor.OrderDistributorDetail', compact('OrdersDistributorDetail' ));

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }


    public function destroy(Request $request)
    {
        try {

        $OrdersDistributor = OrdersDistributor::where('order_id', $request->id)->delete();
        $OrdersDetail = OrdersDistributorDetail::where('order_id', $request->id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('distributor.orders.index');

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }

    /*********Start  Desgin Reports ********************* */

    public function OrderReport()
    {

        return view('pages.reports.orderReport');
    }


    public function SearchOrderReport(Request $request){



          $start_at = date($request->start_at);
          $end_at = date($request->end_at);


            $invoices = OrdersDistributor::with('distrubute_order')->whereBetween('created_at',[$start_at,$end_at])->get();
          $count = $invoices->count();
          $sum = $invoices->sum('total_price');
          return view('pages.reports.orderReport',compact( 'start_at','end_at','count','sum'))->withDetails($invoices);



    }


}
