<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\EventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();





Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});


 //==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');



   //==============================dashboard============================
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });


    //==============================Classrooms============================
    Route::group(['namespace' => 'web'], function () {


        // Start  user management check.email rest.password  my.account

        Route::Post('/add-user', 'UserController@CheckEmail')->name('User.index');
        Route::get('/manage-users', 'UserController@ManageUsers')->name('manage.users');
        Route::POST('/store-user', 'UserController@RegisterUsers')->name('register.store');
        Route::get('/edit-users/{id}', 'UserController@EditUsers')->name('edit.users');
        Route::POST('/update-users', 'UserController@UpdateUsers')->name('update.user');
        Route::POST('/delete-users', 'UserController@DeleteUsers')->name('user.destroy');

        Route::get('/manage-my-account/{id}', 'UserController@ManageMyAcount')->name('manage.my.account');
        Route::POST('/update-users-profile', 'UserController@UpdateUsersProfile')->name('update.user.profile');


        Route::get('/check-email', 'UserController@CheckEmail')->name('check.email.index');
        Route::POST('/check-email-verfiy', 'UserController@CheckEmailBYVerfiy')->name('check.email');
        Route::post('/rest-password', 'UserController@RestPassword')->name('rest.password');
        Route::get('/update/{email}', 'UserController@updateData')->name('User.index.update');
        // End user management


        /*************************** my  route *******************************/

        // ******************************* Start expenses *******************************

        Route::resource('expenses', 'ExpensesController');
        Route::POST('/createxpenses' , 'ExpensesController@Store') ->name('expenses.create');
        Route::get('expenses-report' , 'ExpensesController@Reports') ->name('expenses.report');
        Route::POST('expenses-serach' , 'ExpensesController@SearchExpenses') ->name('Report.Search.expenses');

        // ******************************* end expenses SearchExpenses *******************************


        // ******************************* Start Pricing *******************************

        Route::resource('priceProduct', 'PriceProductController');

        // ******************************* End  Pricing *******************************

        // ******************************* Start Pricing *******************************

        Route::resource('priceDelivery', 'PriceDeliveryController');
        Route::POST('creatPriceDelivery' , 'PriceDeliveryController@Store') ->name('priceDelivery.create');

        // ******************************* End  Pricing *******************************


        // ******************************* Start Products *******************************

        Route::resource('products', 'ProductsController');
        Route::POST('/creatProduct' , 'ProductsController@Store') ->name('products.create');

        // ******************************* End  Products *******************************


        // ******************************* Start   Distributor  *******************************

        Route::resource('distributor', 'DistributorController'); //

       // ******************************* End     Distributor *******************************


        // ******************************* Start sales points *******************************

        Route::GET('sales-point', 'SalesPointController@index')->name('sales.point.index');
        Route::GET('sales-table', 'SalesPointController@Tableindex')->name('sales.point.table');
        Route::POST('sales-update', 'SalesPointController@Update')->name('salesPoints.update');
        Route::post('sales-destroy', 'SalesPointController@Destroy')->name('salesPoints.destroy');
        Route::GET('sales-point-location/{id}', 'SalesPointController@SalesPointLocation')->name('sales.point.location');
        Route::GET('sales-point-location-distrbuter/{distributId}', 'SalesPointController@SalesPointLocationDistrbuter')->name('sales.point.location.distributId');
        // ******************************* End sales points salesPoints.update *******************************



          // ******************************* Start Start OrdersDistributor *******************************
          Route::get('order-distributor-show', 'OrdersDistributorController@index')->name('distributor.orders.index');
          Route::POST('order-distributor-destroy', 'OrdersDistributorController@destroy')->name('ordersDistributor.destroy');
          Route::get('order-distributor-detail/{orderID}', 'OrdersDistributorController@ShowDetail')->name('distributor.orders.detail');

          Route::get('order-distributor-report' , 'OrdersDistributorController@OrderReport') ->name('distributor.orders.report');
          Route::POST('order-distributor-report-one-show' , 'OrdersDistributorController@SearchOrderReport') ->name('distributor.report.order.one.show');

        // ******************************* End  Start OrdersDistributor *******************************

         // ******************************* Start Start SalesDistributor *******************************
         Route::get('sales-distributor-show', 'SalesDistributorController@index')->name('distributor.sales.index');
         Route::get('sales-distributor-detail/{salesID}', 'SalesDistributorController@ShowDetailSales')->name('distributor.sales.detail');
         Route::POST('sales-distributor-destroy', 'SalesDistributorController@destroy')->name('sales.distributor.destroy');

         Route::get('sales-distributor-report' , 'SalesDistributorController@SalesReport') ->name('distributor.sales.report');
         Route::POST('sales-distributor-report-one-show' , 'SalesDistributorController@SearchSalesReport') ->name('distributor.report.sales.one.show');


       // ******************************* End  Start SalesDistributor *******************************



        // ******************************* Start Inventory *******************************
        Route::get('inventory-product', 'InventoryController@index')->name('inventory.index');
        Route::POST('inventory-product-update' , 'InventoryController@updateProduct') ->name('inventory.product.update');

        Route::resource('material', 'MaterialController');
        Route::POST('/creatMaterial' , 'MaterialController@Store') ->name('material.create');

        Route::get('inventory-materials', 'InventoryController@indexMaterials')->name('inventory.material.index');
        Route::POST('inventory-materials-update' , 'InventoryController@updateMaterials') ->name('inventory.material.update');

       /************************* End  Inventory **************************************/


        // ******************************* Start DebtCollection *******************************
        Route::get('show-agel-price', 'UserController@ShowAgelPrice')->name('dashbord.agel.display');
        Route::get('show-collec-debet' , 'UserController@ShowCollecDebt') ->name('dashbord.collec.debet');

       /************************** End  DebtCollection **************************************/


         #*************************** Report  Chart and  monitoring  ********************************************
        Route::get('admin-monitoring' , 'ReportController@DisplayMonitoring')-> name('admin.show.monitoring');
        Route::get('admin-report-one' , 'ReportController@DisplayReportOne')-> name('admin.report.one');
        Route::get('admin-report-two' , 'ReportController@DisplayReporttwo')-> name('admin.report.two');

       // Route::get('report-order' , 'ReportController@OrderReport')-> name('admin.report.order');

        #*************************** End Report  Chart and  monitoring  ********************************************

	////////////// HR/////////////////////////////////////
        Route::resource('employees', 'HrController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('salarys', 'SalaryController');
        Route::resource('vications', 'VicationController');

	////////////// HR/////////////////////////////////////


	////////////// comlayments/////////////////////////////////////
	Route::resource('complayments', 'ComplaymentController');
	////////////// comlayments/////////////////////////////////////

	////////////// presolution /////////////////////////////////////
	Route::resource('presolutions', 'PresolutionController');
	////////////// presolution/////////////////////////////////////



        // ******************************* Start    Orders  ready Product *******************************
        Route::Get('order-customer-product-come-to-ready-product', 'OrderReadyController@OrderCustomerProductComeToReadyProduct')->name('order.customer.product.come.to.ready.product');
        Route::Get('order-customer-product-ready-product', 'OrderReadyController@OrderCustomerProductReadyProduct')->name('order.customer.product.ready.product');
        Route::Get('order-detail-product-ready-product/{id}', 'OrderReadyController@OrderDetailProductReadyProdcut')->name('order.detail.product.ready.product');
        Route::Get('send-order-to-delivery/{id}', 'OrderReadyController@SendOrderToDelivery')->name('send.order.to.delivery');

        // ******************************* End    Orders  ready Product  *******************************


         ////////////// Start Reporting  /////////////////////////////////////

         Route::get('report-order', 'ReportOrderController@index')->name('report.order.index');
         Route::post('report-order-export', 'ReportOrderController@exportReportOrder')->name('report.order.one');

         ////////////// End Reporting  /////////////////////////////////////

        /*************************** End my  route  report.order.one *******************************/





    });
   //fullcalender

});
