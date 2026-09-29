<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Models\Materials;
use App\Models\Benefactor;
use App\Models\Donations;
use Illuminate\Http\Request;


class  MaterialController extends Controller
{

    public function index()
    {
        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        // return    student Data All
        $materials = Materials::selection()->get();
       // $donations = Donations::selection()->get();
        //$benefactors = Benefactor::selection()->get();



        return view('pages.material.Material', compact('materials'));
    }



    public function  Store(StoreMaterial $request){


        try {

            $validated = $request->validated();

            $materialstore = Materials::create([
                'name'=> $request->name ,
                'code'=> $request->code ,
                'price'=> $request->price,
                'type'=>$request->type
            ]);



            toastr()->success(trans('messages.success'));
            return redirect()->route('material.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(StoreMaterial $request ){

        try {
            $validated = $request->validated();
            $materials = Materials::findOrFail($request->id);
            $materials->update([

                $materials->name = $request->name,
                $materials->code = $request->code,
                $materials->price = $request->price,
                $materials->type = $request->type,


        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('material.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {

        $materials = Materials::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('material.index');

    }

}
