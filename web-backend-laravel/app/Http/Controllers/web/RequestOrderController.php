<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterial;
use App\Http\Requests\StoreProducts;
use App\Models\CustomerOrder;
use App\Models\Customers;

use App\Models\OrderCustomerId;
use App\Models\Orders;
use App\Models\PriceProduct;
use App\Models\Products;
use App\Models\PriceDelivery;
use App\Models\؛PriceingProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class  RequestOrderController extends Controller
{

    public function index($customerID)
    {
        try {


        $products = DB::select('SELECT `productID` as id  ,`productName` as name , `margin_price`,`descrip`  ,`size` ,`quantity` ,  `marerailID` , `materailName`, `materailPrice`  , sum(totalPrice) + margin_price as totalSum FROM `tbl_totalprice` GROUP BY `productID`');

        /*********************** create equation *************************/
        $getPricingProduct = PriceProduct::sum('price');

        $priceDeliveries = PriceDelivery::selection()->get();

        /******************** End create equation ***************************/

        $orderId = OrderCustomerId::find(1);
        if($orderId->order_id != 0 ){
            $artificial_id = $orderId->order_id ;

            $customerRequest = DB::select(
                'SELECT * FROM `tbl_view_ordercustomer` WHERE `order_id`='.$artificial_id .' AND `customer_id`='.$customerID);

            // ****************  التأكد من ان ليس هنالك طلبية لم يتم اكمالها *******************//
            if(!$customerRequest){
                  $findIDOrderCustomer = CustomerOrder::where(['order_id' =>$artificial_id ])->Selection()->get();
                 toastr()->error(trans('لديك طلبية يجب اكمالها'));
                 return redirect()->route('request.order.index' , $findIDOrderCustomer[0]->customer_id);
            }

           $priceDelivery =  $customerRequest[0]->price_delivery;

           $totalOrderPrice = 0;

           for($i=0 ; $i < sizeof($customerRequest); $i++ ){
               $totalOrderPrice = $totalOrderPrice + $customerRequest[$i]->total_price;
           }

            return view('pages.orders.request', compact('products' ,'getPricingProduct' ,'customerID' , 'customerRequest' , 'priceDelivery','totalOrderPrice','priceDeliveries'));

        }





        return view('pages.orders.request', compact('products' ,'getPricingProduct' ,'customerID' ,'priceDeliveries'));

           // toastr()->success(trans('messages.success'));
           // return redirect()->route('request.order.index' , $request ->customerID);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public  function  CustomerShow(){

        $customers = Customers::Selection()->get();

        return view('pages.orders.CustomerOrder', compact('customers' ));
    }



    public  function  AddProduct(Request  $request){

        try {

        /************  حفظ ID  الطلبية التي يعمل عليه حاليا **************/
        $orderId = OrderCustomerId::find(1);
        if($orderId->order_id == 0){
            $artificial_id =  rand(1, 100000);
            $orderId->update([ $orderId->order_id = $artificial_id, ]);
        }else{
            $artificial_id = $orderId->order_id;
        }


         $checkProduct = DB::select(
             'SELECT * FROM `tbl_customer_order` WHERE `order_id` ='.$artificial_id .' AND `product_id`='.$request->productID
         );

         if($checkProduct){
              return redirect()->back()->withErrors(['error' => "هذا المنتج تمت اضافة مسبقا"]);
         }

         //  **************** تاكد من الكمية موجوده في المخزن *********************
         if($request ->quantity  > $request ->quantityStore){
             return redirect()->back()->withErrors(['error' => "هذة الكمية غير متوفرة في المخزن"]);
         }



            $customerOrder = CustomerOrder::create([
                'order_id'=> $artificial_id ,
                'customer_id'=> $request->customerID,
                'product_id'=> $request->productID ,
                'product_quantity'=> $request->quantity,
                'total_price'=> $request->priceProduct * $request->quantity,
                'price_delivery'=> 0,
            ]);

             //******  نقص الكمية من المخزن *******//
            $products = Products ::findOrFail($request->productID);
            $products->update([
                $products->quantity = $request->quantityStore - $request ->quantity,
            ]);


            toastr()->success(trans('messages.success'));
            return redirect()->route('request.order.index' , $request ->customerID);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public  function  UpdateRequsetProductCustomer(Request $request){

try{
        $customerProduct = CustomerOrder::findOrFail($request->customerOrderId);

        $customerProduct->update([
            $customerProduct->product_quantity = $request ->newQuantity,
        ]);

       //**************  تعديل كمية المنتج المطلوبة ***********//
        $products = Products ::findOrFail($request->productId);
        $returnQuantity = $products->quantity + $request ->oldQuantity;
        $products->update([
            $products->quantity = $returnQuantity - $request ->newQuantity,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('request.order.index' , $request ->customerID);

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }




    public function  DeleteRequsetProductCustomer(Request  $request){

        try{


        $customerProduct = CustomerOrder::findOrFail($request->id)->delete();

        //******  ارجاع الكمية الي  المخزن *******//
        $products = Products ::findOrFail($request->productId);

        $products->update([
            $products->quantity = $products->quantity + $request ->productQuantity,
        ]);

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('request.order.index' , $request -> customerId);

        }catch (\Exception $e) {
            return $e;
        }

    }

    public  function  PriceDeliveryProductCustomer(Request  $request){

        $orderId = OrderCustomerId::find(1);

        $customerOrder= CustomerOrder::where(['order_id' =>$orderId->order_id ])->Selection()->get();


        CustomerOrder::where('order_id', $orderId->order_id)
            ->update([
           "address_delivery" => $request ->addressDelivery,
            "price_delivery" => $request ->priceDelivery,
        ]);

        return redirect()->route('request.order.index' , $customerOrder[0]['customer_id']);
    }


    public  function  ConfirmProductCustomer(Request  $request){

        try{
        $orderId = OrderCustomerId::find(1);


         $detailOrder = DB::select(
            'SELECT * , SUM(`total_price`) as total_order_price FROM `tbl_view_ordercustomer` WHERE `order_id`='.$orderId->order_id.' LIMIT 1'
        );


        return view('pages.orders.ConfirmOrder' , compact('detailOrder'));

      //  return view('pages.orders.request', compact('products' ,'getPricingProduct' ,'customerID'));

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }

    public  function  SaveOrderProductIntableOrder($status){

        try {
        $orderId = OrderCustomerId::find(1);

           $detailOrder = DB::select(
            'SELECT * , SUM(`total_price`) as total_order_price FROM `tbl_view_ordercustomer` WHERE `order_id`='.$orderId->order_id.' LIMIT 1'
        );

        $saveOrder = Orders::create([
            'id'=> $detailOrder[0] ->order_id ,
            'barcode'=> $detailOrder[0] ->order_id,
            'customer_id'=> $detailOrder[0] ->customer_id ,
            'date'=> $detailOrder[0] ->created_at,
            'hours'=> $detailOrder[0] ->created_at ,
            'status'=> $status,
            'total_order'=> $detailOrder[0] ->total_order_price ,
            'price_delivery'=> $detailOrder[0] ->price_delivery,
            'address_delivery'=> $detailOrder[0] ->address_delivery,
        ]);

        $orderId = OrderCustomerId::find(1);

        $orderId->update([ $orderId->order_id = 0, ]);

        return redirect()->route('order.customer.product.sending' );
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public  function  OrderCustomerProductPending(){

        $orderPandding = Orders::where('status', '0')->Selection()->get();

        return view('pages.orders.OrderPending', compact('orderPandding'));

    }

    public  function  OrderDetailProductPending($orderID){

        try{
        $customerRequest = DB::select(
            'SELECT *  FROM `tbl_view_ordercustomer` WHERE `order_id`='.$orderID
        );

        $priceDelivery =  $customerRequest[0]->price_delivery;
        $showorderId =  $customerRequest[0]->order_id;

        $totalOrderPrice = 0;

        for($i=0 ; $i < sizeof($customerRequest); $i++ ){
            $totalOrderPrice = $totalOrderPrice + $customerRequest[$i]->total_price;
        }

        $statusis = Orders::find($orderID);

        $showStutas =  $statusis->status;

        return view('pages.orders.DetailPendding', compact('customerRequest' , 'priceDelivery','totalOrderPrice' ,'showorderId' , 'showStutas'));

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }

    public  function SendOrderUpdateStatusToOne($orderId){
        $customerRequest = Orders::where('id', $orderId)
            ->update(['status' => 1]);

        toastr()->success(trans('تم ارسال الطلب الي قسم التجهيز'));
        return redirect()->route('order.customer.product.pending');

    }
    public function OrderCustomerProductSending(){
        try{
        $orderSending = Orders::where('status', '1')->Selection()->get();

        return view('pages.orders.OrderSending', compact('orderSending'));

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }

    public  function  OrderProductRequestPendingDelete($orderId){

        $deleteOrderProduct = Orders::findOrFail($orderId)->delete();
        $deleteOrderProductDetaile = CustomerOrder::Where( 'order_id',$orderId)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('order.customer.product.pending');


    }

    public function  Store(StoreProducts $request){

        try {

            $validated = $request->validated();

            $productstore = Products::create([
                'name'=> $request->name ,
                'size'=> $request->size,
                'descrip'=> $request->descrip ,
                'margin_price'=> $request->marginprice,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(StoreProducts $request ){

        try {
            $validated = $request->validated();
            $products = Products ::findOrFail($request->id);
            $products->update([

                $products->name = $request->name,
                $products->size = $request->size,
                $products->descrip = $request->descrip,
                $products->margin_price = $request->marginprice,

        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('products.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request  $request)
    {

        $products = Products::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('products.index');

    }

}
