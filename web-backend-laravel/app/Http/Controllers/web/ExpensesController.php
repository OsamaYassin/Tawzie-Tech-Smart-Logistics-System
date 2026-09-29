<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Models\Expenses;
use App\Models\Benefactor;
use App\Models\Donations;
use Illuminate\Http\Request;


class  ExpensesController extends Controller
{

    public function index()
    {
        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        // return    student Data All
        $expenses = Expenses::selection()->get();



        return view('pages.expenses.Expenses', compact('expenses'));
    }



    public function  Store(Request $request){


        try {



            $Expensestore = Expenses::create([
                'name'=> $request->name ,
                'value'=> $request->value ,
                'comment'=> $request->comment,
            ]);



            toastr()->success(trans('messages.success'));
            return redirect()->route('expenses.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(Request $request ){

        try {

            $Expenses = Expenses::findOrFail($request->id);
            $Expenses->update([

                $Expenses->name = $request->name,
                $Expenses->value = $request->value,
                $Expenses->comment = $request->comment,

        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('expenses.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {

        $Expenses = Expenses::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('expenses.index');

    }


    public function Reports(){
        return view('pages.expenses.Report_expenses');
    }

    public function SearchExpenses(Request $request){

        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $expenses_name = $request->name;

       return $expensesReports = Expenses::whereBetween('created_at',[$start_at,$end_at])->get();

        return view('pages.expenses.Report_expenses',compact('expenses_name','start_at','end_at','expensesReports'));




       /* if ($request->expenses && $request->start_at =='' && $request->end_at =='') {

           $invoices = Expenses::select('*')->where('name', 'LIKE', "%" . $request->expenses . "%")->get();

           $student_name = $request->expenses;


           return view('pages.expenses.Report_expenses',compact('student_name'))->withDetails($invoices);
        }

        // في حالة تحديد تاريخ استحقاق
        else {

          $start_at = date($request->start_at);
          $end_at = date($request->end_at);
          $student_name = $request->expenses;

          $invoices = Expenses::whereBetween('attendence_date',[$start_at,$end_at])->where('student_name', 'LIKE', "%" . $request->expenses . "%")->get();

          return view('pages.expenses.Report_expenses',compact('student_name','start_at','end_at'))->withDetails($invoices);

        }*/



    }

}
