<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePresolution;
use Illuminate\Support\File;
use App\Models\Presolution;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Products;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class PresolutionController extends Controller
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
            $presolutions = Presolution::selection()->get();

            $products = Products::selection()->get();

            return view('pages.complayments_solutions.presolutions', compact('presolutions','products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $presolutions = Presolution::selection()->get();


        return view('presolutions' , compact('presolutions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function  Store( StorePresolution $request){

            $List_Classes = $request->List_Classes;


            try {

                $validated = $request->validated();
                foreach ($List_Classes as $List_Class) {
                    $My_Classes = new Presolution();
                    $My_Classes->complayment = $List_Class['complayment'];
                    $My_Classes->product_name =  $List_Class['product_name'];
                    $My_Classes->solution = $List_Class['solution'];
                    $My_Classes->save();

                            toastr()->success(trans('messages.success'));
                            return redirect()->route('presolutions.index');

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
    public function update(StorePresolution $request)
    {
        try {
                    $pre = Presolution::findOrFail($request-> id);
                    $pre->update([
                        $pre->complayment = $request->complayment,
                        $pre->product_name = $request->product_name,
                        $pre->solution = $request->solution,

                    ]);
                        toastr()->success(trans('messages.Update'));
                        return redirect()->route('presolutions.index');

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

        $pre = Presolution::findOrFail($request-> id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('presolutions.index');

    }

}
