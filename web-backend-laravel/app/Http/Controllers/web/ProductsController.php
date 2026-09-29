<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProducts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class  ProductsController extends Controller
{

    public function index()
    {

        $products = Products::selection()->get();

        return view('pages.products.Products', compact('products'));
    }



    public function  Store(Request $request){


        try {

           // $validated = $request->validated();

            $productstore = Products::create([
                'product_name'=> $request->name ,
                'size'=> $request->size,
                'descrip'=> $request->descrip ,
                'price'=> $request->price,
            ]);



            toastr()->success(trans('messages.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(Request $request ){

        try {
           // $validated = $request->validated();
            $products = Products ::findOrFail($request->id);
            $products->update([

                $products->product_name = $request->product_name,
                $products->size = $request->size,
                $products->descrip = $request->descrip,
                $products->price = $request->price,

        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('products.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {

        $products = Products::findOrFail($request->id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('products.index');

    }

}
