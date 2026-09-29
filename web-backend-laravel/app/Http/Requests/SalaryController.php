<?php

namespace App\Http\Controllers\web;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalary;
use App\Http\Requests\StoreTeacher;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SalaryController extends Controller
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
            $salarys = Salary::selection()->get();



            return view('pages.My_Classes.salary', compact('employees' , 'salarys'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$salary = Salary::selection()->get();


        //return view('salary' , compact('salary'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function  Store( StoreSalary $request){


            $List_Classes = $request->List_Classes;

            try {

                $validated = $request->validated();
                foreach ($List_Classes as $List_Class) {
                    $My_Classes = new Salary();


                    $My_Classes->id =  $List_Class['id'];
                    $My_Classes->name =  $List_Class['name'];
                    $My_Classes->salary =  $List_Class['salary'];
                    $My_Classes->save();
                            toastr()->success(trans('messages.success'));
                            return redirect()->route('employees.index');
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
    public function update(StoreSalary $request)
    {

        try {
                    $salary = Salary::findOrFail($request-> id);
                    $salary->update([
                        $salary->salary = $request->salary,
                    ]);
                        toastr()->success(trans('messages.Update'));
                        return redirect()->route('departments.index');

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
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('employees.index');

    }

}
