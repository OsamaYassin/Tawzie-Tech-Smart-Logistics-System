<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DistributionPoint;
use App\Models\OrderInfo;
use App\Models\OrderReports;
use App\Models\Products;
use App\Models\SalesInfo;
use App\Models\SalesReports;
use App\Models\ShowSalesReport;
use App\Models\debtCollection;
use App\Traits\GeneralTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    use  GeneralTraits;


    public  function  DisplayData(){
         $products = Products::selection()->get();

        return $this-> returnData('products' ,$products);
    }


    public  function  SaveProduct(Request  $request ){

          $products = Products::  create([

            'product_name' => $request -> name,
            'size' => $request -> size,
            'descrip' =>$request -> descrip,
            "price"=>$request -> price,
            'available_amount' => $request->amount,
            ]);


         return $this-> returnData('products' ,$products);
    }

    public  function  deleteProduct(Request  $request ){

        $products = Products::where('product_id' , $request-> productID)->delete();


       return $this-> returnData('products' ,$products);
  }





}
