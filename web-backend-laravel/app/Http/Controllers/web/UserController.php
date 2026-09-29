<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\User;
use App\Models\SalesDistributor;
use App\Models\DebtCollection;
use App\Models\Employee;
use App\Models\SalesReports;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class  UserController extends Controller
{

    public function index()
    {

        $employee = Employee::selection()->get();

        return view('auth.registerUser'  , compact('employee'));
    }



    public function  ManageUsers(){

        $manageUsers = User::selection()->get();
        return view('auth.mangeUser'  , compact('manageUsers'));

    }



    public function  EditUsers($userId){

        $manageUsers = User::where('id' , $userId)->selection()->get();

        $employee = Employee::selection()->get();

         return view('auth.updateUser'  , compact('manageUsers', 'employee'));

    }

    public function  UpdateUsers(Request $request){

        try{
                $usersotre =    User::where('id', $request-> id )
                ->update([
                  'name'=> $request->name ,
                  'email'=> $request->email,
                  'password'=> Hash::make($request->password),
                  'part_acount'=> $request->input('part_acount') ,
                  'part_materail'=> $request->input('part_materail'),
                  'part_product'=> $request->input('part_product'),
                  'part_inventor'=> $request->input('part_inventor'),
                  'part_hr'=> $request->input('part_hr'),
                  'part_lab1'=> $request->input('part_lab1'),
                  'part_lab2'=> $request->input('part_lab2'),
                  'part_lab3'=> $request->input('part_lab3'),
                  'part_customer'=> $request->input('part_customer'),
                  'part_aftersales'=> $request->input('part_aftersales'),
                  'part_delivery'=> $request->input('part_delivery'),
                  'part_redayorder'=> $request->input('part_redayorder'),
              ]);

                  toastr()->success(trans('messages.success'));
                  return redirect()->route('manage.users');

        }  catch (\Exception $e) {

            // return  $e->getMessage();
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }

    }


    public  function UpdateUsersProfile(Request $request){

        try{
                $usersotre =    User::where('id', $request-> id )
                ->update([
                  'name'=> $request->name ,
                  'email'=> $request->email,
                  'password'=> Hash::make($request->password),
                ]);

                toastr()->success(trans('messages.success'));
                return redirect()->back();

      }  catch (\Exception $e) {

          // return  $e->getMessage();
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }





    public function ManageMyAcount($userId){

        try{

            $manageUsers = User::where('id' , $userId)->selection()->get();

            return view('auth.myProfile'  , compact('manageUsers'));

        }  catch (\Exception $e) {

            // return  $e->getMessage();
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }

    }


    public  function  CheckEmail(){

        return view('auth.checkemail');
    }

    public  function  CheckEmailBYVerfiy(Request  $request){

        //check if email in database if found go to re password
        $users = User::where(['email' => $request->email])->get();
        $emails = $request->email ;

        if ($users->count() > 0){
            return view('auth.restpasswrod' , compact(['emails']) );
        }else{
            return redirect()->back()->withErrors(['error' => "كلمة المرور غير صحيحة"]);
        }

        // return $request -> email ;

    }

    public  function  RestPassword(Request  $request){


        User::where('email', $request-> email )
            ->update([
                'password' =>  Hash::make($request-> password) ,
            ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('manage.users');

    }

    public function  RegisterUsers (Request $request){


        try {


          //  return $request ;

           // return $request->input('part_acount');

          $usersotre =    User::create([
            'name'=> $request->name ,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'part_acount'=> $request->input('part_acount') ,
            'part_materail'=> $request->input('part_materail'),
            'part_product'=> $request->input('part_product'),
            'part_inventor'=> $request->input('part_inventor'),
            'part_hr'=> $request->input('part_hr'),
            'part_lab1'=> $request->input('part_lab1'),
            'part_lab2'=> $request->input('part_lab2'),
            'part_lab3'=> $request->input('part_lab3'),
            'part_customer'=> $request->input('part_customer'),
            'part_aftersales'=> $request->input('part_aftersales'),
            'part_delivery'=> $request->input('part_delivery'),
            'part_redayorder'=> $request->input('part_redayorder'),
        ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('manage.users');
        } catch (\Exception $e) {

           // return  $e->getMessage();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function  edit(){


    }
    public function store()

    {


    }

    public function updateData( $email)
    {

        $getname =  Auth::user()->name ;
        $getemail =  Auth::user()->email ;

        $users = User::where([
                'name' => $getname,
                'email' => $getemail ]
        )->limit(3)->selection()->get();

        $password =   Crypt::decrypt($users[0]['password']);

        return $password;
        //return $users[0]['password'];

    }



    public function DeleteUsers(Request $request)
    {
        $users = User::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('manage.users');

    }


      public function ShowAgelPrice(){
        try{


          //PointRelation
             $showAgelPrice = SalesDistributor::with("distrubute_sales")-> where('agel' , '!=', 0)->get();

           return view('pages.reports.showAgel', compact('showAgelPrice'));

      } catch (\Exception $ex) {
          return redirect() ->back()->with(['error' => 'لم يتم التعديل']);
      }

      }

      public function ShowCollecDebt(){
          try{


            //PointRelation
               $showCollectDebet = DebtCollection::with('point_debt')->get();

             return view('pages.reports.showCollectDebet', compact('showCollectDebet'));

        } catch (\Exception $ex) {
            return redirect() ->back()->with(['error' => 'لم يتم التعديل']);
        }

        }

}
