<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Orders;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class  ReportOrderController extends Controller
{

    public function index()
    {

        return view('pages.reports.orderReport');
    }

    //exportReportOrder

    public function exportReportOrder(Request $request){


        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $invoices = Orders::whereBetween('created_at',[$start_at,$end_at])->get();
        $count = $invoices->count();
        $sum = $invoices->sum('total_order');
        $sumDeleviry = $invoices->sum('price_delivery');
        return view('pages.My_Classes.Report_Order_invoice',compact('start_at','end_at','count','sum' ,'sumDeleviry' , 'start_at' ,'end_at'))->withDetails($invoices);
}

    public function Search_invoices(Request $request){


              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              $invoices = Invoice::whereBetween('created_at',[$start_at,$end_at])->get();
              $count = $invoices->count();
              $sum = $invoices->sum('amount');
              return view('pages.My_Classes.Report_invoice',compact('start_at','end_at','count','sum'))->withDetails($invoices);
      }

        public function Print_invoice( $id)
        {

           $invoices = Invoice::where('id',$id)->first();
            return view('pages.My_Classes.print_invoice',compact('invoices','id'));

        }








}
