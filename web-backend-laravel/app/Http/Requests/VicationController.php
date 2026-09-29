<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVication;
use App\Http\Requests\StoreTeacher;
use App\Models\Employee;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\Salary;
use App\Models\Teachers;
use App\Models\Vication;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class VicationController extends Controller
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
            $vications = Vication::selection()->get();



            return view('pages.My_Classes.vications', compact('vications'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vication = Vication::selection()->get();

        return view('vication' , compact('vication'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function  Store( StoreVication $request){

            $vication = Vication::selection()->get();

            $List_Classes = $request->List_Classes;

            try {

                $validated = $request->validated();
                foreach ($List_Classes as $List_Class) {
                    $My_Classes = new Vication();

                    $My_Classes->v_name =  $List_Class['name'];
                    $My_Classes->v_duration =  $List_Class['duration'];
                    $My_Classes->start_date =  $List_Class['start_date'];
                    $My_Classes->end_date = $List_Class['end_date'];
                    $My_Classes->save();

                            toastr()->success(trans('messages.success'));
                            return redirect()->route('vications.index');

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
    public function update(StoreVication $request)
    {

        try {

                    $vic = Vication::findOrFail($request-> id);
                    $vic->update([
                        $vic->v_name = $request->name,
                        $vic->v_duration = $request->duration,
                        $vic->start_date = $request->start_date,
                        $vic->end_date = $request->end_date,
                    ]);
                        toastr()->success(trans('messages.Update'));
                        return redirect()->route('vications.index');

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

        $vic = Vication::findOrFail($request-> id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('vications.index');

    }

}
