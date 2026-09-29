<?php

namespace App\Http\Controllers\web;
use \SimpleSoftwareIO\SMS\Facades\SMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\StoreTeacher;
use App\Models\Department;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Classroom;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class DepartmentController extends Controller
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
            $departments = Department::selection()->get();



            return view('pages.hr.departments', compact('departments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Department::selection()->get();

        return view('department' , compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function  Store( StoreDepartment $request){
           // SMS::send('This is my message', [], function($sms) {
             //   $sms->to('+249964860638');
            //});
            $List_Classes = $request->List_Classes;
            try {

                $validated = $request->validated();
                foreach ($List_Classes as $List_Class) {
                    $My_Classes = new Department();


                    $My_Classes->name =  $List_Class['name'];

                    $My_Classes->save();
                }

                toastr()->success(trans('messages.success'));
                return redirect()->route('departments.index');
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
    public function update(StoreDepartment $request)
    {
        try {
            $dep = Department::findOrFail($request-> id);
            $dep->update([

                $dep->e_name = $request->name,

            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('departments.index');
            }
            catch
            (\Exception $e) {
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

        $emp = Department::findOrFail($request-> id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('departments.index');

    }

}
