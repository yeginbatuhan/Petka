<?php

namespace App\Http\Controllers;

use App\Models\PetkaStock;
use App\Models\PetkaStockDetail;
use Illuminate\Http\Request;
use App\Models\User;

class PetkaStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
  {
    $petka_stock_page = new PetkaStock();

    return response()->json($petka_stock_page->petka_stock_page(), 200);
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
        ["link" => "/", "name" => "Home"], ["link" => route('ptk_stock_index'), "name" => "Petka Stok Listesi"], ["name" => "Stok Ekle"]
      ];
      return view('pages.ptk-stock-create', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('userid'));


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
      ],
        [
          'user_id.required' => 'Bu Alan Boş Olamaz ',
        ]);
      $ptkdata = $request->except('_token', 'detail');
      $ptk = PetkaStock::create($ptkdata);
      if ($ptk) {
        $detaildata = $request->except('_token','petka_stock_code','petka_stock_name_tr','petka_stock_name_en','user_id');


        foreach ($detaildata['detail'] as $dt) {

          $dt['petka_stock_id'] = $ptk->id;

          $detail = PetkaStockDetail::create($dt);
        }
        return Redirect()->route('ptk_stock_index')->with('success', 'Petka Stok Eklenmesi Başarılı');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PetkaStock  $petkaStock
     * @return \Illuminate\Http\Response
     */
    public function show(PetkaStock $petkaStock)
    {
      $ptk = PetkaStock::all();

      $pageConfigs = ['pageHeader' => true];
      $breadcrumbs = [
        ["link" => "/", "name" => "Home"], ["name" => "Petka Stok Listesi"]
      ];
      return view('pages.ptk-stock-index',
        ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs],
        compact('ptk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PetkaStock  $petkaStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ptk = PetkaStock::find($id);
      return view('pages.ptk-stock-edit', compact('ptk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetkaStock  $petkaStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $data = $request->except('_token');
      PetkaStock::find($id)->update($data);
      return Redirect()->route('ptk_stock_index')->with('success', 'Stok Güncellemesi Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetkaStock  $petkaStock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      PetkaStock::find($id)->delete();
      return Redirect()->route('ptk_stock_index')->with('success', 'Stok Başarıyla Silindi');
    }



  public function detail($id)
  {
    $stockid=$id;
    $data = PetkaStockDetail::wherePetkaStockId($id)->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "Seçili Stoğun Detayı"]
    ];
    return view('pages.ptk-stock-detail-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('data','stockid'));
  }

  public function detailedit($id)
  {
    $detailedit = PetkaStockDetail::find($id);
    return view('pages.ptk-stock-detail-edit', compact('detailedit'));

  }

  public function detailupdate(Request $request, $id)
  {
    $detaildata = $request->except('_token');

    PetkaStockDetail::find($id)->update($detaildata);
    return Redirect()->route('ptk_stock_index')->with('success', 'Stok Detay Güncellemesi Başarılı');

  }

  public function detailadd($petka_stock_id)
  {
    $stockid=$petka_stock_id;
    $add = PetkaStockDetail::wherePetkaStockId($petka_stock_id)->get();
    return view('pages.ptk-stock-detail-add', compact('add','stockid'));
  }

  public function detailstore(Request $request)
  {
    $detailstore = $request->except('_token');
    $dt = PetkaStockDetail::create($detailstore);
    return Redirect()->route('ptk_stock_index')->with('success', 'Stok Detay Eklenmesi Başarılı');
  }
  public function detaildelete($id)
  {
    PetkaStockDetail::find($id)->delete();
    return Redirect()->route('ptk_stock_index')->with('success', 'Stok Detay Başarıyla Silindi');
  }
}
