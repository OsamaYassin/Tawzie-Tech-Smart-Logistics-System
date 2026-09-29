<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Http\Requests\StoreProducts;
use App\Models\Distributor;

use App\Models\PriceProduct;
use App\Models\Products;
use App\Models\؛PriceingProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class  DistributorController extends Controller
{

    public function index()
    {
        try {

        $distributor = Distributor::Selection()->get();

        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        return view('pages.distributor.Distributor', compact('distributor' ));

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }



    public function  Store(Request $request){

        try {

            $distributor = Distributor::create([
                'name'=> $request->name ,
                'phone_one'=> $request->phoneone,
                'phone_two'=> $request->phonetwo ,
                'address'=> $request->address,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('distributor.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function AdddistributorDirict(Request $request){


        try {

            $checkActive = 0;
            if($request->active =="on"){
               $checkActive = 1;
            }

            $distributor = Distributor::create([
                'name' => $request->name ,
                'phone' => $request->phone ,
                'username' => $request->username ,
                'area_name' => $request->area_name ,
                'vihicle_no' => $request->vihicle_no ,
                'email' => $request->email ,
                'active' => $checkActive ,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('order.distributor.show');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request ){

        try {

            $checkActive = 0;
            if($request->active =="on"){
               $checkActive = 1;
            }


            $distributor = Distributor ::findOrFail($request->id);
            $distributor->update([

                $distributor->name = $request->name,
                $distributor->phone = $request->phone,
                $distributor->username = $request->username,
                $distributor->password = $request->password,
                $distributor->vihicle_no = $request->vihicle_no,
                $distributor->area_name = $request->area_name,
                $distributor->active =$checkActive,

        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('distributor.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {
        try {

        $distributor = Distributor::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('distributor.index');

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }
}
