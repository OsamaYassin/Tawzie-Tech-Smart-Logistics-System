<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Http\Requests\StoreProducts;
use App\Models\Distributor;
use App\Models\OrdersDistributor;
use App\Models\OrdersDistributorDetail;
use App\Models\SalesDistributorDetail;
use App\Models\SalesDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class  SalesDistributorController extends Controller
{

    public function index()
    {
        try {

             $SalesDistributor = SalesDistributor::with('distrubute_sales','distrubuter_points')->Selection()->get();

            //  $SalesDistributor[0] -> distrubute_sales ->point_name;

        return view('pages.distributor.SalesDistributor', compact('SalesDistributor' ));

    } catch (\Exception $e) {

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }





    public function ShowDetailSales($salesID)
    {
        try {



         $SalesDistributorDetail = SalesDistributorDetail::where('sales_id', $salesID)->Selection()->get();

       //return $OrdersDistributorDetail[0]-> product_order_detail ;


        return view('pages.distributor.SalesDistributorDetail', compact('SalesDistributorDetail' ));

    } catch (\Exception $e) {
        return $e;
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }


    public function destroy(Request $request)
    {
        try {

            //return $request->sales_id;
        $OrdersDistributor = SalesDistributor::where('sales_id', $request->sales_id)->delete();
        $OrdersDetail = SalesDistributorDetail::where('sales_id', $request->sales_id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('distributor.sales.index');

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }


    public function SalesReport()
    {

        return view('pages.reports.salesReport');
    }


    public function SearchSalesReport(Request $request){



        $start_at = date($request->start_at);
        $end_at = date($request->end_at);


          $invoices = SalesDistributor::with('distrubute_sales','distrubuter_points')->whereBetween('created_at',[$start_at,$end_at])->get();
        $count = $invoices->count();
        $sum = $invoices->sum('total_price');
        return view('pages.reports.salesReport',compact( 'start_at','end_at','count','sum'))->withDetails($invoices);



  }

}
