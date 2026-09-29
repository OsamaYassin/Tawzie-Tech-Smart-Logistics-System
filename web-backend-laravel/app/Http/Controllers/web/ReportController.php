<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Http\Requests\StoreTeacher;
use App\Models\Donations;
use App\Models\Students;
use App\Models\Classroom;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class  ReportController extends Controller
{





    public  function  DisplayMonitoring(){
        //check if user Register or not

        return view('pages.chartReports.moniter');
    }
    public  function  DisplayReportOne(){

        return view('pages.chartReports.report');
    }
    public  function  DisplayReporttwo(){

        return view('pages.chartReports.culasterReport');
    }


    public function OrderReport()
    {

        return view('pages.reports.orderReport');
    }
    
    public function Search_invoices(Request $request){



            if ($request->type && $request->start_at =='' && $request->end_at =='') {

               $invoices = Donations::select('*')->where('type','=',$request->type)->get();

               $type = $request->type;

               $count = $invoices->count();
               $sum = $invoices->sum('amount');
               return view('pages.My_Classes.Report',compact('type','count','sum'))->withDetails($invoices);
            }

            // في حالة تحديد تاريخ استحقاق
            else {

              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              $type = $request->type;

              $invoices = Donations::whereBetween('created_at',[$start_at,$end_at])->where('type','=',$request->type)->get();
              $count = $invoices->count();
              $sum = $invoices->sum('amount');
              return view('pages.My_Classes.Report',compact('type','start_at','end_at','count','sum'))->withDetails($invoices);

            }



        }

        public function Print_domations( $id)
        {

           $invoices = Donations::where('id',$id)->first();
            return view('pages.My_Classes.print_donation',compact('invoices','id'));

        }








}
