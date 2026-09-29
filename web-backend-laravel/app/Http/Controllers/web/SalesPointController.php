<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Models\SalesPoints;
use App\Models\Distributor;
use Illuminate\Http\Request;


class  SalesPointController extends Controller
{

    public function index()
    {
        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        // return    student Data All
        $salesPoints = SalesPoints::with('distrubute_relation')->selection()->get();

        $countPoints = $salesPoints->count() ;

        return view('pages.SalesPoint.salesPoint', compact('salesPoints' ,'countPoints'));
    }

    public function Tableindex()
    {
        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        // return    student Data All
         $salesPoints = SalesPoints::with('distrubute_relation')->selection()->get();

         $distributor = Distributor::Selection()->get();

        $countPoints = $salesPoints->count() ;

        return view('pages.SalesPoint.TablesalesPoint', compact('salesPoints' ,'countPoints' ,'distributor'));
    }



    public function Update(Request $request ){

        try {

           // return $request ;
            $SalesPoints = SalesPoints::findOrFail($request->id);
            $SalesPoints->update([

                $SalesPoints->point_name = $request->name,
                $SalesPoints->type = $request->type,
                $SalesPoints->phone = $request->phone,
                $SalesPoints->distribut_id = $request->distributerID,

        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('sales.point.table');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {

        $SalesPoints = SalesPoints::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('sales.point.table');

    }

    public function SalesPointLocation($id)
    {
        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        // return    student Data All
        try{
         $salesPoints =  SalesPoints::with('distrubute_relation')->where('id' ,$id )->selection()->get();


         $countPoints = $salesPoints->count() ;

         return view('pages.SalesPoint.salesPoint', compact('salesPoints' ,'countPoints'));

    }
    catch
    (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

     }

     public function SalesPointLocationDistrbuter($distributId)
     {
         //check if user Register or not
         // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

         // return    student Data All
         try{
            
          $salesPoints =  SalesPoints::with('distrubute_relation')->where('distribut_id' ,$distributId )->selection()->get();

          $countPoints = $salesPoints->count() ;

          return view('pages.SalesPoint.salesPoint', compact('salesPoints' ,'countPoints'));

     }
     catch
     (\Exception $e) {
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }

      }



}
