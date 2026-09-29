<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\File;
use App\Models\Employee;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\Salary;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class HrController extends Controller
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
            $employees = Employee::selection()->get();

            $department = Department:: selection()->get();

            return view('pages.hr.employees', compact('employees','department'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::selection()->get();
        $employees = Salary::selection()->get();

        return view('employees' , compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function  Store( StoreEmployee $request){

            $departments = Department::selection()->get();

            $List_Classes = $request->List_Classes;
            //$path = $request->file('cv')->store('public/files');

            try {

                $validated = $request->validated();
                foreach ($List_Classes as $List_Class) {
                    $My_Classes = new Employee();
                    $sal = new Salary();

                    $My_Classes->e_name =  $List_Class['name'];
                    $My_Classes->e_email =  $List_Class['email'];
                    $My_Classes->e_cv = "none";
                  //  $My_Classes->path = $path;

                    //$My_Classes->path = $path;
                    //$sal->id = $My_Classes->id;
                    $sal->e_name = $List_Class['name'];
                   foreach($departments as $department){

                            $My_Classes->e_department = $List_Class['department'];
                            $sal->e_department = $List_Class['department'];
                            $My_Classes->save();
                            $sal->save();
                            toastr()->success(trans('messages.success'));
                            return redirect()->route('employees.index');

                    }
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
    public function update(StoreEmployee $request)
    {
        $departments = Department::selection()->get();
        try {
            foreach($departments as $department){
                if( $department->name == $request->department){
                    $emp = Employee::findOrFail($request-> id);
                    $emp->update([
                        $emp->e_name = $request->name,
                        $emp->e_email = $request->email,
                        $emp->e_department = $request->department,
                        $emp->e_cv = $request->cv,

                    ]);
                        toastr()->success(trans('messages.Update'));
                        return redirect()->route('employees.index');
                    }else{
                        toastr()->error(trans('القسم غير موجود'));
                        return redirect()->route('employees.index');
                    }
                }
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

        $emp = Employee::findOrFail($request-> id)->delete();
        $sal = Salary::findOrFail($request-> id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('employees.index');

    }

}
