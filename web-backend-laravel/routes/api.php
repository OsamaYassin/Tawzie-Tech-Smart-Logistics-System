<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//, namespace => 'Api'


//http://localhost/tawzie-project/tawzie-safc-api/api/display-prodeuct
//http://localhost/tawzie-project/tawzie-safc-api/api/save-prodeuct
//http://localhost/tawzie-project/tawzie-safc-api/api/delete-prodeuct

//********************************* Start  Api products ********************************************** */

Route::get('/display-prodeuct' , 'api\ProductController@DisplayData');
Route::post('/save-prodeuct' , 'api\ProductController@SaveProduct');
Route::post('/delete-prodeuct' , 'api\ProductController@deleteProduct');

//********************************* End  Api products ********************************************** */


   Route::post('dashboard/dashboard-data' , 'api\DistributerPointController@DashboardData');

   Route::post('dashboard/dashboard-data-count-point' , 'api\DistributerPointController@getCountPointAndCountVisitDashboard');

    //DistributerInfo
    Route::get('/display' , 'api\DistributerInfoController@DisplayData');
    Route::post('/save' , 'api\DistributerInfoController@saveData');
    Route::post('/login' , 'api\DistributerInfoController@CheckLogin');

    //get product  Price
   Route::post('product/price' , 'api\DistributerPointController@ProductPrice');


     //distributionpoint
    Route::get('point/display' , 'api\DistributerPointController@DisplayData');
    Route::post('point/save' , 'api\DistributerPointController@saveData');
    Route::post('point/distributor-point' , 'api\DistributerPointController@DisplayDistributorPoint');

    Route::post('point/deactive-point' , 'api\DistributerPointController@DeActiveDistributorPoint');


    //Function update all visit /yes to no visit no
    Route::post('point/distributor-point-update-no' , 'api\DistributerPointController@DistributerUpdateNo');
    //Route::post('point/login' , 'api\DistributerInfoController@CheckLogin'); display-by-id

    //Order Product
    Route::post('order-product/save' , 'api\OrderProductController@OrderProduct');
        //localhost:8080/dall-project/api/pro/api/sales-product/save

        //Order OrderDetailDistrbuter
   Route::post('order-deatil/display' , 'api\OrderProductController@OrderDetailDistrbuter');

    //sales Product
    Route::post('sales-product/save' , 'api\OrderProductController@SalesProduct');

    //DisplaySalesProductOfDistrubuter    DisplaySalesProductOfDistrubuterToday
    Route::post('display-sales-report/display' , 'api\OrderProductController@DisplaySalesProductOfDistrubuter');

    Route::post('display-sales-report-today/display' , 'api\OrderProductController@DisplaySalesProductOfDistrubuterToday');

    // display customer sales history
    Route::post('display-customer-sales-history/display' , 'api\OrderProductController@DisplayCustomerSalesHistory');

     // display All  customer    Agle
     Route::post('display-customers-agle/display' , 'api\OrderProductController@DisplayCustomersAgel');

    // تعديل  بيانات الدفعية القديمة  و تحصيل الحاصل
    Route::post('pay-dept-sales/update' , 'api\OrderProductController@PayDeptSalesUpdate');

    //   اجمالي عمل اليوم =  الاجمالي + الكاش + الدين + بنكك + اجمالي البيع اليوم
    Route::post('total-work-today' , 'api\OrderProductController@TotalWorkToday');
