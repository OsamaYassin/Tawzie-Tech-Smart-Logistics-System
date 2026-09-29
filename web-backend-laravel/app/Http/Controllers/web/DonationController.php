<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Http\Requests\StoreDonation;
use App\Models\Episodes;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Donations;
use App\Models\Classroom;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class  DonationController extends Controller
{

    public function index()
    {
        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        // return    student Data All
        $donations = Donations::selection()->get();
        $benefactors = Benefactor::selection()->get();



        return view('pages.My_Classes.Donations', compact('donations','benefactors'));
    }



    public function  Store(StoreDonation $request){


        $List_Classes = $request->List_Classes;



        try {

            $validated = $request->validated();
            foreach ($List_Classes as $List_Class) {

                $My_Classes = new Donations();


                $My_Classes->type = $List_Class['type'];
                $My_Classes->amount = $List_Class['amount'];
                $My_Classes->discription = $List_Class['discription'];
                $My_Classes->benefactor_id = $List_Class['benefactor_id'];


                $My_Classes->save();

            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('Donations.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(Request $request )
    {
        try {
        $Classrooms = Donations::findOrFail($request->id);
        $Classrooms->update([

            $Classrooms->type = $request->type,
            $Classrooms->amount = $request->amount,
            $Classrooms->discription = $request->discription,
            $Classrooms->benefactor_id = $request->benefactor_id,

        ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('Donations.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {

        $Classrooms = Donations::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Donations.index');

    }

}
