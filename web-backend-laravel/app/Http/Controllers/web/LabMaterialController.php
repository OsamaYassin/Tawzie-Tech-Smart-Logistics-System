<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLabMaterial;
use Illuminate\Support\File;
use App\Models\Lab;
use App\Models\Students;
use App\Models\Benefactor;
use App\Models\Classroom;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Models\PriceProduct;
use App\Models\Products;
use App\Models\ProductComponent;
 
use App\Models\LabCombin;







class LabMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //check if user Register or not
            // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}

            // return    student Data All
            $products = DB::select('SELECT `productID` as id  ,`productName` as name , `margin_price`,`descrip`  ,`size` ,  `marerailID` , `materailName`, `materailPrice`  , sum(totalPrice) + margin_price as totalSum FROM `tbl_totalprice` GROUP BY `productID`');

            /*********************** create equation *************************/
            $getPricingProduct = PriceProduct::sum('price');

            /******************** End create equation ***************************/

            //check if user Register or not
            // if(!session()->has('UserNameAdmin') ){return view('admin.auth.login');}


            return view('pages.labs.labProducts', compact('products' ,'getPricingProduct'));

    }

    public function LapProductComponent($product_id)
    {

         $products = Products::with("materialsRelation")-> find($product_id);

        $productComponentUnit = ProductComponent::where(['id_product' => $product_id])->selection()->get();

        // return materail to display in drowpdown list when cteate new materail
        $mararials = Materials::selection()->get();

        /*********************** create equation *************************/

          $getPricingProduct = PriceProduct::sum('price'); //get Pricing Product  تغليف + التسوق +الايدي العاملة
          $productMarginPrice = $products->margin_price; // get Product margin
          $priceProdutPlusMarginP =  $getPricingProduct + $productMarginPrice ;

        /******************** End create equation ***************************/

        return view('pages.labs.labProductComponent', compact('productComponentUnit','products'  ,'mararials' ,'priceProdutPlusMarginP'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function  ProductCombinSubmit(Request $request){

             $List_Classes  = ProductComponent::where(['id_product' => $request->product_id])->selection()->get();

           //  return $List_Classes[0]->id_materail;

             try {

                $artifsialId = rand(1, 100000) ;
                 for ($i=0 ;$i < $List_Classes->count() ; $i++) {


                    //get Matarials name
                       $matairalName = Materials::where(['id' =>$List_Classes[$i]->id_materail])->selection()->get();

                    LabCombin::create([
                        'id_combin'=>   $artifsialId,
                        'name'=> $matairalName[0]->name,
                        'code'=> $matairalName[0]->code,
                        'type_matrail'=> $matairalName[0]->type_matrail,
                        'num_unit_order'=>$List_Classes[$i]->num_unit *   $request->num_units,
                        'numuint'=> $List_Classes[$i]->num_unit ,
                        'request_unit'=> $request->num_units ,
                        'product_id'=>  $request->product_id,
                        'product_name'=> $request->product_name
                    ]);
                }
                    toastr()->success(trans('messages.success'));
                    return redirect()->route('show-send-compain-to-lab',$artifsialId);



            } catch (\Exception $e) {
              //  return  $e->getMessage();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

        }

        public function CompainLab(){

            $labCombination = LabCombin::selection()->groupBy('id_combin')->get();

           return view('pages.labs.labCombin', compact('labCombination',));
        }

        public function ShowSendCompainToLab($lab_compin_id)
        {

            $labCombination = LabCombin::where(['id_combin' => $lab_compin_id])->selection()->get();

            return view('pages.labs.showSendCombinToLab', compact('labCombination',));

        }


        public function LabCombinOne(){
             $labCombination = LabCombin::where(['lab_work' => 1 ,'work_done'=>0])->selection()->groupBy('id_combin')->get();
            return view('pages.labs.construction_lab', compact('labCombination',));
        }

        public function LabCombinTwo(){
             $labCombination = LabCombin::where(['lab_work' => 2 ,'work_done'=>0 ])->selection()->groupBy('id_combin')->get();
            return view('pages.labs.construction_lab', compact('labCombination',));
        }



        public function  LabCombinThree(){

            //product_ready
            $labCombination = LabCombin::where('labthree' , 1 )->where('product_ready' , 0)->selection()->groupBy('id_combin')->get();

            return view('pages.labs.ShowLabThreeCombin', compact('labCombination',));
        }

        public function DetailCompainLabThree($lab_compin_id)
        {

            try{

            $labCombination = LabCombin::where(['id_combin' => $lab_compin_id])->selection()->groupBy('lab_work')->get();

              $producs = Products::where(['id' =>$labCombination[0]->product_id])->selection()->get();

            $producsName = $producs[0]->name;
            $combinId = $labCombination[0]->id_combin;

            return view('pages.labs.detailCombinLabThree', compact('labCombination','producsName','combinId'));

                }catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }


        }

        public function ProductCombinLabThreeDone($combinId ){


            try{

                  $labCombination = LabCombin::where(['id_combin' => $combinId]);

                foreach( $labCombination as $labCombin){
                    if($labCombin->work_done == 0){
                        toastr()->error(trans('  المكونات غير كاملة  '));

                         return redirect()->back();
                    }
                }


                $labCombination->update([ 'product_ready'=> 1]);

                toastr()->success(trans('تم   تركيب المنتج'));
                return redirect()->route('lab.compain.three');


            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
            }

            public function  AllLabCombinThreeDone(){

                //product_ready
                $labCombination = LabCombin::where(['product_ready' => 1])->selection()->groupBy('id_combin')->get();
                $productReady = 1;
                return view('pages.labs.ShowLabThreeCombin', compact('labCombination','productReady'));
            }





        public function ShowAllCombinLabDone($labTpey){
            $labCombination = LabCombin::where(['lab_work' =>$labTpey ,'work_done'=>1])->selection()->groupBy('id_combin')->get();
           return view('pages.labs.construction_lab', compact('labCombination',));
       }

        public function LabCombinSpesficLab($combinId , $labType){

              $labCombination = LabCombin::where(['id_combin' => $combinId , 'lab_work' => $labType ])->selection()->get();

              //check if product part combin in lab two

              $checkpartCombins = 0;
              //chanage tye of lab
              $changetypelab= $labType;
             if($changetypelab== 2){
                $changetypelab = 1;
                  //التأكداذا كان جزاء من التركيبة في لاب 2
             $checkpartCombin = LabCombin::where('id_combin' , $combinId )->where('lab_work' , $changetypelab)->where('work_done' ,0 )->selection()->get();

              if($checkpartCombin->count() > 0){
                $checkpartCombins =  $checkpartCombin->count() ;
                return view('pages.labs.displayLabCombinSpesfic', compact('labCombination','combinId','labType' ,'checkpartCombins'));

              }

            }
             //  return $checkpartCombin->count();

              return view('pages.labs.displayLabCombinSpesfic', compact('labCombination','combinId','labType' ,'checkpartCombins'));

        }

        public function CombinLabDone($combinId , $labType){

            if($labType == 1){
                $labCombination = LabCombin::where(['id_combin' => $combinId , 'lab_work' => $labType ])->update([
                    'work_done'=>1
                  ]);
            }  if($labType == 2){
                $labCombination = LabCombin::where('id_combin' , $combinId )->update([
                    'work_done'=>1,
                    'labthree'=>1
                  ]);
            }


              //labthree

              if($labType == 1 ){
                return redirect()->route('lab.compain.one',$labType);
              }elseif($labType == 2){
                return redirect()->route('lab.compain.two',$labType);

              }

             // return view('pages.labs.displayLabCombinSpesfic', compact('labCombination','combinId','labType'));

        }




        public function SendCompainToLab($combinId , $lab){


        try{

            $labCombination = LabCombin::findOrFail($combinId);

            $labCombination->update([ $labCombination->lab_work = $lab]);

            toastr()->success(trans('تم ارسال الي المعمل'));
            return redirect()->route('show-send-compain-to-lab', $labCombination->id_combin);


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        }





}
