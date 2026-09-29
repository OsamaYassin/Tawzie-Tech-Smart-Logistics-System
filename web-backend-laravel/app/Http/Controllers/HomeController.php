<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Http\Requests\StoreDonation;
use Illuminate\Support\Facades\Auth;
use App\Models\Episodes;
use Illuminate\Support\Facades\DB;
use App\Models\Students;
use App\Models\SalesDistributor;
use App\Models\Donations;
use App\Models\Classroom;
use App\Models\DebtCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $showDebetTotal = SalesDistributor::sum('agel');

        $ldate = date('Y-m-d H:i:s');

        $year =date('Y');
        $months=date('m');
        $day=date('d');

         $showDebtCollection = DB::table('tw_debt_collection')
        ->select(DB::raw(' SUM(`chash`) AS chash , SUM(`banckk`) AS banckk , SUM(`sheck`) AS sheck'))
        ->where(['year' =>  $year , 'months' =>  $months , 'day' =>  $day , ])
        ->get();

         $sumTypeOfDebet = $showDebtCollection[0] ->chash + $showDebtCollection[0] ->banckk + $showDebtCollection[0] ->banckk ;

        if (Auth::user()->admin == 1){

            return view('dashboard',compact(['sumTypeOfDebet' ,'showDebetTotal']));
        }


    }





}
