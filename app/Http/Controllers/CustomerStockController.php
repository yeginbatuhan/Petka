<?php

namespace App\Http\Controllers;

use App\Models\CustomerStock;
use App\Models\CustomerStockDetail;
use Illuminate\Http\Request;
use App\Models\User;
class CustomerStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
  {
    $customer_stock_page = new CustomerStock();

    return response()->json($customer_stock_page->customer_stock_page(), 200);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function create()
  {
    $userid = User::where('user_type', '=', '1')->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["link" => route('cst_stock_index'), "name" => "Müşteri Numune Listesi"], ["name" => "Numune Ekle"]
    ];
    return view('pages.cst-stock-create', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('userid'));


  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request)
  {

    $data = $request->validate([
      'user_id' => 'required',
      'customer_stock_detail_unit'=>'required',
    ],
      [
        'user_id.required' => 'Bu Alan Boş Olamaz ',
        'customer_stock_detail_unit.required' => 'Bu Alan Boş Olamaz ',
      ]);
    $cstdata = $request->except('_token', 'detail');
    $cst = CustomerStock::create($cstdata);
    if ($cst) {
      $detaildata = $request->except('_token','customer_stock_code','customer_stock_name_tr','customer_stock_name_en','user_id');


      foreach ($detaildata['detail'] as $dt) {

        $dt['customer_stock_id'] = $cst->id;

        $detail = CustomerStockDetail::create($dt);
      }
      return Redirect()->route('cst_stock_index')->with('success', 'Numune Eklenmesi Başarılı');
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerStock  $customerStock
     * @return \Illuminate\Http\Response
     */
  public function show(CustomerStock $customerStock)
  {
    $cst = CustomerStock::all();

    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "Müşteri Numune Listesi"]
    ];
    return view('pages.cst-stock-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs],
      compact('cst'));
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerStock  $customerStock
     * @return \Illuminate\Http\Response
     */
  public function edit($id)
  {
    $cst = CustomerStock::find($id);
    return view('pages.cst-stock-edit', compact('cst'));
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerStock  $customerStock
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, $id)
  {

    $data = $request->except('_token');
    CustomerStock::find($id)->update($data);
    return Redirect()->route('cst_stock_index')->with('success', 'Müşteri Numune Güncellemesi Başarılı');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerStock  $customerStock
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
  {
    CustomerStock::find($id)->delete();
    return Redirect()->route('cst_stock_index')->with('success', 'Müşteri Numunesi Başarıyla Silindi');
  }


  public function detail($id)
  {
    $cstid=$id;
    $data = CustomerStockDetail::whereCustomerStockId($id)->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "Seçili Numunenin Detayı"]
    ];
    return view('pages.cst-stock-detail-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('data','cstid'));
  }
  public function detailedit($id)
  {
    $detailedit = CustomerStockDetail::find($id);
    return view('pages.cst-stock-detail-edit', compact('detailedit'));
  }
  public function detailupdate(Request $request, $id)
  {
    $detaildata = $request->except('_token');

    CustomerStockDetail::find($id)->update($detaildata);
    return Redirect()->route('cst_stock_index')->with('success', 'Numune Detayı Güncellemesi Başarılı');

  }
  public function detailadd($customer_stock_id)
  {
    $cstid=$customer_stock_id;
    $add = CustomerStockDetail::whereCustomerStockId($customer_stock_id)->get();
    return view('pages.cst-stock-detail-add', compact('add','cstid'));
  }

  public function detailstore(Request $request)
  {
    $detailstore = $request->except('_token');
    $dt = CustomerStockDetail::create($detailstore);
    return Redirect()->route('cst_stock_index')->with('success', 'Numune Detay Eklenmesi Başarılı');
  }
  public function detaildelete($id)
  {
    CustomerStockDetail::find($id)->delete();
    return Redirect()->route('cst_stock_index')->with('success', 'Numune Detayı  Başarıyla Silindi');
  }
}
