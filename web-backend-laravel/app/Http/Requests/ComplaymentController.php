<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplayment;
use Illuminate\Support\File;
use App\Models\Complayment;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Classroom;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ComplaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //check if user Register or not
            // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

            // return    student Data All
            $complayments = Complayment::selection()->get();



            return view('pages.My_Classes.complayment', compact('complayments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $complayments = Complayment::selection()->get();


        return view('complayments' , compact('complayments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function  Store( StoreComplayment $request){

            $List_Classes = $request->List_Classes;


            try {

                $validated = $request->validated();
                foreach ($List_Classes as $List_Class) {
                    $My_Classes = new Complayment();
                    $My_Classes->o_id =  $List_Class['o_id'];
                    $My_Classes->product_name =  $List_Class['product_name'];
                    $My_Classes->customer_name =  $List_Class['customer_name'];
                    $My_Classes->customer_phone =  $List_Class['customer_phone'];
                    $My_Classes->complayment = $List_Class['complayment'];
                    $My_Classes->solution = $List_Class['solution'];
                    $My_Classes->status = $List_Class['status'];
                    $My_Classes->save();

                            toastr()->success(trans('messages.success'));
                            return redirect()->route('complayments.index');

                        }

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreComplayment $request)
    {
        try {

                    $comp = Complayment::findOrFail($request-> id);
                    $comp->update([
                        $comp->o_id = $request->o_id,
                        $comp->product_name = $request->product_name,
                        $comp->customer_name = $request->customer_name,
                        $comp->customer_phone = $request->customer_phone,
                        $comp->complayment = $request->complayment,
                        $comp->solution = $request->solution,
                        $comp->status = $request->status,

                    ]);
                        toastr()->success(trans('messages.Update'));
                        return redirect()->route('complayments.index');

                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {

        $comp = Complayment::findOrFail($request-> id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('complayments.index');

    }

}
