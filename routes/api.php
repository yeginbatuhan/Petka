<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\UsersCreateController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferDetailController;
use App\Http\Controllers\PetkaStockController;
use App\Http\Controllers\PetkaStockDetailController;
use App\Http\Controllers\CustomerStockController;
use App\Http\Controllers\CustomerStockDetailController;
use App\Http\Controllers\OngoingController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PermitDetailController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [ApiController::class, 'login']);
//Route::post('register', [ApiController::class, 'register']);
Route::get('get_main_page', [MainPageController::class, 'index']);

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
  Route::get('orderpage',[OrderController::class,'index'])->name('orderpage');
  Route::get('orderdetails/{id}',[OrderDetailController::class,'index'])->name('orderdetail');
  Route::get('newspage',[NewsController::class,'index'])->name('newspage');
  Route::get('permitpage',[PermitController::class,'index'])->name('permitpage');

  Route::controller(UsersCreateController::class)->group(function (){
    Route::get('userprofile','userinde')->name('user_list');
    Route::put('user/{user}','userupdateapi')->name('user_update');
  });
  Route::get('offerpage',[OfferController::class,'index'])->name('offerpage');
  Route::get('offerdetail/{id}',[OfferDetailController::class,'index'])->name('offerdetail');


  Route::get('ptkstockpage',[PetkaStockController::class,'index'])->name('ptkstockpage');
  Route::get('ptkstockdetail/{id}',[PetkaStockDetailController::class,'index'])->name('ptkstockdetail');


  Route::get('cststockpage',[CustomerStockController::class,'index'])->name('cststockpage');
  Route::get('cststockdetail/{id}',[CustomerStockDetailController::class,'index'])->name('cststockdetail');
  Route::get('ongoingpage',[OngoingController::class,'index'])->name('ongoingpage');



  Route::get('promotiongpage',[PromotionController::class,'index'])->name('promotiongpage');

  Route::get('permitpage',[PermitController::class,'index'])->name('permitpage');
  Route::get('permitdetails/{id}',[PermitDetailController::class,'index'])->name('permitdetail');
});

