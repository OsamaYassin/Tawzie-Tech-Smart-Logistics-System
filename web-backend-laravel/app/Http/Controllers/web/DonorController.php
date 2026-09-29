<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Http\Requests\StoreTeacher;
use App\Models\Episodes;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Classroom;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class  DonorController extends Controller
{

    public function index()
    {
        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        // return    student Data All
        $donors = Benefactor::selection()->get();



        return view('pages.My_Classes.Donor', compact('donors'));
    }



    public function  Store(StoreTeacher $request){


        $List_Classes = $request->List_Classes;

        return  $request->List_Classes;

        try {

            $validated = $request->validated();
            foreach ($List_Classes as $List_Class) {

                $My_Classes = new Benefactor();


                $My_Classes->name = $List_Class['name'];
                $My_Classes->phone = $List_Class['phone'];
                $My_Classes->address = $List_Class['address'];


                $My_Classes->save();

            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('Doners.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(StoreTeacher $request )
    {
        try {
        $Classrooms = Benefactor::findOrFail($request->id);
        $Classrooms->update([

            $Classrooms->name = $request->name,
            $Classrooms->phone = $request->phone,
            $Classrooms->address = $request->address,

        ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('Doners.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {

        $Classrooms = Benefactor::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Doners.index');

    }

}
