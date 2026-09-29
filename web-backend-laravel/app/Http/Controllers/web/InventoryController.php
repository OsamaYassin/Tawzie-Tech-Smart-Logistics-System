<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Http\Requests\StoreProducts;
use App\Models\Materials;
use App\Models\PriceProduct;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class  InventoryController extends Controller
{

    public function index()
    {


        $products = Products::Selection()->get();

        /*********************** create equation *************************/

        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        return view('pages.inventory.Products', compact('products' ));
    }





    public function updateProduct(Request $request ){

        try {
             $products = Products ::findOrFail($request->id);
             $sumQuantity =  $request->oldquantity + $request->newquantity ;
             $products->update([ $products->available_amount =$sumQuantity,]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('inventory.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function indexMaterials()
    {


        $materials = Materials::selection()->get();

        /*********************** create equation *************************/

        //check if user Register or not
        // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

        return view('pages.inventory.Material', compact('materials' ));
    }




    public function updateMaterials(Request $request ){

        try {
            $material= Materials::findOrFail($request->id);
            $sumQuantity =  $request->oldquantity + $request->newquantity ;
            $material->update([ $material->quantity =$sumQuantity,]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('inventory.material.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }






}
