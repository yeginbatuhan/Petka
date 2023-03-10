<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PersonNewsController;
use App\Http\Controllers\UsersCreateController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PetkaStockController;
use App\Http\Controllers\CustomerStockController;
use App\Http\Controllers\OngoingController;
use App\Http\Controllers\PromotionController;
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

Route::get('/test',[PermitController::class,'testTable'])->name('test');

Auth::routes(['verify' => true]);
Route::redirect('/', '/auth/login');

// Authentication  Route
Route::group(['prefix' => 'auth'], function () {
  Route::get('login', [AuthenticationController::class, 'loginPage'])->name('auth-login');
  Route::post('login', [AuthenticationController::class, 'login'])->name('login');
});

Route::group(['middleware' => ['auth']], function () {
  Route::get('/',
    [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
  Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
  Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');


// page Route
  Route::group(['prefix' => 'page'], function () {
    Route::resource('notifications', NotificationController::class);
  });


// locale Route
  Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('lang-locale');

  Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');


  Route::controller(UsersCreateController::class)->group(function () {
    Route::get('/users', 'index')->name('user_index');
    Route::get('/users_add', 'create')->name('user_add');
    Route::post('/users_store', 'store')->name('user_store');
    Route::get('/users_excel_add', 'show')->name('users_excel_add');
    Route::post('/users_excel_store', 'import')->name('import');
    Route::get('/users_edit/{user}', 'edit')->name('user_edit');
    Route::post('/users_update/{id}', 'update')->name('user_update');
    Route::get('/users_delete/{user}', 'destroy')->name('user_delete');
    Route::get('/users_excel_download', 'download')->name('user_excel_download');
    route::get('/users_password_update/{user}', 'updatepassword')->name('update_password');
  });

  Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'show')->name('order_index');
    Route::get('/order_add', 'create')->name('order_add');
    Route::post('/order_store', 'store')->name('order_store');
    Route::get('/order_edit/{id}', 'edit')->name('edit');
    Route::post('/order_update/{id}', 'update')->name('update');
    Route::get('/order_delete/{id}', 'destroy')->name('delete');
    Route::get('/order_detail_edit/{id}', 'detailedit')->name('order_detail_edit');
    Route::post('/order_detail_update/{id}', 'detailupdate')->name('order_detail_update');
    Route::get('/order_detail_delete/{id}', 'detaildelete')->name('order_detail_delete');
    Route::get('/order_detail/{id}', 'detail')->name('detail');
    Route::get('/orders_excel_add', 'excelshow')->name('orders_excel_add');
    Route::post('/orders_excel_store', 'import')->name('order_import');
    Route::get('/order_detail_excel_add', 'exceldetail')->name('order_detail_excel_add');
    Route::post('/order_detail_excel_store', 'importdetail')->name('order_detail_import');
    Route::get('/order_excel_download', 'downloadone')->name('order_excel_download');
    Route::get('/order_detail_excel_download', 'downloadtwo')->name('order_detail_excel_download');
    Route::get('/order_detail_add/{order_id}', 'formdet')->name('order_detail_add');
    Route::post('/order_detail_store', 'formadd')->name('order_detail_store');


  });
  Route::controller(PermitController::class)->group(function () {
    Route::get('/permit', 'show')->name('permit_index');
    Route::get('/permit_user_detail/{id}', 'show_detail')->name('permit_user_detail');
    Route::get('/permit_add', 'create')->name('permit_add');
    Route::post('/permit_store', 'store')->name('permit_store');
    Route::get('/permit_edit/{id}', 'edit')->name('permit_edit');
    Route::post('/permit_update/{id}', 'update')->name('permit_update');
    Route::get('/permit_delete/{id}', 'destroy')->name('permit_delete');
    Route::get('/permit_detail/{id}', 'detail')->name('permit_detail');
    Route::get('/permit_detail_edit/{id}', 'detailedit')->name('permit_detail_edit');
    Route::post('/permit_detail_update/{id}', 'detailupdate')->name('permit_detail_update');
    Route::get('/permit_detail_delete/{id}', 'detaildelete')->name('permit_detail_delete');
    Route::get('/permit_detail_add/{offer_id}', 'detailadd')->name('permit_detail_add');
    Route::post('/permit_detail_store', 'detailstore')->name('permit_detail_store');
    Route::get('/permit_detail_delete/{id}', 'detaildestroy')->name('permit_detail_delete');
  });

  Route::controller(NewsController::class)->group(function () {
    Route::get('/new', 'show')->name('new_index');
    Route::get('/new_add', 'create')->name('new_add');
    Route::post('/new_store', 'store')->name('new_store');
    Route::get('/new_edit/{id}', 'edit')->name('new_edit');
    Route::post('/new_update/{id}', 'update')->name('new_update');
    Route::get('/new_delete/{id}', 'destroy')->name('new_delete');
  });

  Route::controller(PersonNewsController::class)->group(function () {
    Route::get('/person_new', 'show')->name('person_new_index');
    Route::get('/person_new_add', 'create')->name('person_new_add');
    Route::post('/person_new_store', 'store')->name('person_new_store');
    Route::get('/person_new_edit/{id}', 'edit')->name('person_new_edit');
    Route::post('/person_new_update/{id}', 'update')->name('person_new_update');
    Route::get('/person_new_delete/{id}', 'destroy')->name('person_new_delete');
  });
  Route::controller(LogActivityController::class)->group(function () {
    Route::get('/log', 'index')->name('log');

  });

  Route::controller(OfferController::class)->group(function () {
    Route::get('/offers', 'show')->name('offer_index');
    Route::get('/offer_add', 'create')->name('offer_add');
    Route::post('/offer_store', 'store')->name('offer_store');
    Route::get('/offer_edit/{id}', 'edit')->name('offer_edit');
    Route::post('/offer_update/{id}', 'update')->name('offer_update');
    Route::get('/offer_delete/{id}', 'destroy')->name('offer_delete');
    Route::get('/offer_detail/{id}', 'detail')->name('offer_detail');
    Route::get('/offer_detail_edit/{id}', 'detailedit')->name('offer_detail_edit');
    Route::post('/offer_detail_update/{id}', 'detailupdate')->name('offer_detail_update');
    Route::get('/offer_detail_delete/{id}', 'detaildelete')->name('offer_detail_delete');
    Route::get('/offer_detail_add/{offer_id}', 'detailadd')->name('offer_detail_add');
    Route::post('/offer_detail_store', 'detailstore')->name('offer_detail_store');
    Route::get('/offer_detail_delete/{id}', 'detaildestroy')->name('detail_delete');
  });
  Route::controller(PetkaStockController::class)->group(function () {
    Route::get('/ptkstock', 'show')->name('ptk_stock_index');
    Route::get('/ptkstock_add', 'create')->name('ptk_stock_add');
    Route::post('/ptkstock_store', 'store')->name('ptk_stock_store');
    Route::get('/ptkstock_edit/{id}', 'edit')->name('ptk_stock_edit');
    Route::post('/ptkstock_update/{id}', 'update')->name('ptk_stock_update');
    Route::get('/ptkstock_delete/{id}', 'destroy')->name('ptk_stock_delete');
    Route::get('/ptkstock_detail/{id}', 'detail')->name('ptkstock_detail');
    Route::get('/ptkstock_detail_add/{petka_stock_id}', 'detailadd')->name('ptkstock_detail_add');
    Route::post('/ptkstock_detail_store', 'detailstore')->name('ptkstock_detail_store');
    Route::get('/ptkstock_detail_edit/{id}', 'detailedit')->name('ptkstock_detail_edit');
    Route::post('/ptkstock_detail_update/{id}', 'detailupdate')->name('ptkstock_detail_update');
    Route::get('/ptkstock_detail_delete/{id}', 'detaildelete')->name('ptkstock_detail_delete');
    Route::get('/ptkstock_detail_add/{petka_stock_id}', 'detailadd')->name('ptkstock_detail_add');
    Route::post('/ptkstock_detail_store', 'detailstore')->name('ptkstock_detail_store');
  });

  Route::controller(CustomerStockController::class)->group(function () {
    Route::get('/cststock', 'show')->name('cst_stock_index');
    Route::get('/cststock_add', 'create')->name('cst_stock_add');
    Route::post('/cststock_store', 'store')->name('cst_stock_store');
    Route::get('/cststock_edit/{id}', 'edit')->name('cst_stock_edit');
    Route::post('/cststock_update/{id}', 'update')->name('cst_stock_update');
    Route::get('/cststock_delete/{id}', 'destroy')->name('cst_stock_delete');
    Route::get('/cststock_detail/{id}', 'detail')->name('cststock_detail');
    Route::get('/cststock_detail_add/{customer_stock_id}', 'detailadd')->name('cststock_detail_add');
    Route::post('/cststock_detail_store', 'detailstore')->name('cststock_detail_store');
    Route::get('/cststock_detail_edit/{id}', 'detailedit')->name('cststock_detail_edit');
    Route::post('/cststock_detail_update/{id}', 'detailupdate')->name('cststock_detail_update');
    Route::get('/cststock_detail_delete/{id}', 'detaildelete')->name('cststock_detail_delete');
    Route::get('/cststock_detail_add/{customer_stock_id}', 'detailadd')->name('cststock_detail_add');
    Route::post('/cststock_detail_store', 'detailstore')->name('cststock_detail_store');
  });

  Route::controller(OngoingController::class)->group(function () {
    Route::get('/ongoing', 'show')->name('ongoing_index');
    Route::get('/ongoing_add', 'create')->name('ongoing_add');
    Route::post('/ongoing_store', 'store')->name('ongoing_store');
    Route::get('/ongoing_edit/{id}', 'edit')->name('ongoing_edit');
    Route::post('/ongoing_update/{id}', 'update')->name('ongoing_update');
    Route::get('/ongoing_delete/{id}', 'destroy')->name('ongoing_delete');
  });
  Route::controller(PromotionController::class)->group(function () {
    Route::get('/promotion', 'show')->name('promotion_index');
    Route::get('/promotion_add', 'create')->name('promotion_add');
    Route::post('/promotion_store', 'store')->name('promotion_store');
    Route::get('/promotion_delete/{id}', 'destroy')->name('promotion_delete');
  });
});
