<?php

namespace App\Http\Controllers;


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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
    public function index()
    {
        
        $Students = Students::selection()->get();
        $Student = $Students->count();
        return view('dashboard',compact('Student'));
    }

}
