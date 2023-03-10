<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\PermitDetail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PermitController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $permitpage = new Permit();

    return response()->json($permitpage->permit_page(), 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $userid = User::where('user_type', '=', '2')->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["link" => route('permit_index'), "name" => "İzin Durumu"], ["name" => "İzin Ekle"]
    ];
    return view('pages.permit-create', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('userid'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
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

    $permitdata = $request->except('_token', 'detail');
    $permit = Permit::create($permitdata);

      $detaildata = $request->except('_token','user_id','permit_name', 'permit_year', 'permit_total_days');

    if ($detaildata['detail'][0]['permit_detail_start_date']==null)
    {
      return Redirect()->route('permit_index')->with('success', 'İzin Durumu Eklendi');
    }else{
      foreach ($detaildata['detail'] as $dt) {

        $dt['permit_id'] = $permit->id;

        $detail = PermitDetail::create($dt);
      }
      return Redirect()->route('permit_index')->with('success', 'İzin Durumu Eklendi');
    }




  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Permit $permit
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    $permitpage = new Permit();
    $fn = $permitpage->permit_user();
    $data = $fn['data'];
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "İzin Listesi"]
    ];
    return view('pages.permit-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs],
      compact('data'));
  }


  public function show_detail($id)
  {
    $permitdata = Permit::whereUserId($id)->get();


    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "İzin Listesi"]
    ];
    return view('pages.permit-index-detail',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs],
      compact('permitdata'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Permit $permit
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $permitedit = Permit::find($id);
    return view('pages.permit-edit', compact('permitedit'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Permit $permit
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->except('_token');
    Permit::find($id)->update($data);
    return Redirect()->route('permit_index')->with('success', 'İzin Durumu Güncellemesi Başarılı');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Permit $permit
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Permit::find($id)->delete();
    return Redirect()->route('permit_index')->with('success', 'İzin Durumu Silindi');
  }

  public function detail($id)
  {
    $dtid=$id;
    $data = PermitDetail::wherePermitId($id)->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "Seçili İzin Detayı"]
    ];
    return view('pages.permit-detail-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('data','dtid'));
  }

  public function detailedit($id)
  {
    $detailedit = PermitDetail::find($id);
    return view('pages.permit-detail-edit', compact('detailedit'));

  }

  public function detailupdate(Request $request, $id)
  {
    $detaildata = $request->except('_token');
    PermitDetail::find($id)->update($detaildata);
    return Redirect()->route('permit_index')->with('success', 'İzin Detay Güncellemesi Başarılı');
  }

  public function detailadd($permit_id)
  {
    $prmtid=$permit_id;
    $add = PermitDetail::wherePermitId($permit_id)->get();
    return view('pages.permit-detail-add', compact('add','prmtid'));
  }

  public function detailstore(Request $request)
  {
    $detailstore = $request->except('_token');
    $dt = PermitDetail::create($detailstore);
    return Redirect()->route('permit_index')->with('success', 'İzin Detay Eklenmesi Başarılı');
  }

  public function detaildestroy($id)
  {
    PermitDetail::find($id)->delete();
    return Redirect()->route('permit_index')->with('success', 'İzin Detay Başarıyla Silindi');
  }
}
