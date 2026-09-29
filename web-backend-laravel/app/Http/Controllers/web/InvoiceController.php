<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoice;
use App\Http\Requests\StoreDonation;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class  InvoiceController extends Controller
{

    public function index()
    {
        
        $invoices = Invoice::selection()->get();
         return view('pages.My_Classes.Invoice', compact('invoices'));
    }



    public function  Store(StoreInvoice $request){

      
        $List_Classes = $request->List_Classes;

        try {
   
            $validated = $request->validated();
            foreach ($List_Classes as $List_Class) {

                $My_Classes = new Invoice();

               
                $My_Classes->name = $List_Class['name'];
                $My_Classes->amount = $List_Class['amount'];
                $My_Classes->discription = $List_Class['discription'];
              
               

                $My_Classes->save();

            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('Invoice.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(Request $request )
    {
        try {
        $Classrooms = Invoice::findOrFail($request->id);
        $Classrooms->update([

            $Classrooms->name = $request->name,
            $Classrooms->amount = $request->amount,
            $Classrooms->discription = $request->discription,
       ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('Invoice.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    

    public function destroy(Request $request)
    {

        $Classrooms = Invoice::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Invoice.index');

    }

}
