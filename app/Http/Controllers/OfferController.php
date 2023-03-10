<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferDetail;
use Illuminate\Http\Request;
use App\Models\User;

class OfferController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
//  protected $OfferDetail;
//
//
//  public function __construct()
//  {
//      $this->OfferDetail = new OfferDetail;
//  }


  public function index()
  {
    $offer_page = new Offer();

    return response()->json($offer_page->offer_page(), 200);
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
      ["link" => "/", "name" => "Home"], ["link" => route('offer_index'), "name" => "Teklif Listesi"], ["name" => "Teklif Ekle"]
    ];
    return view('pages.offer-create', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('userid'));


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
    $offerdata = $request->except('_token', 'detail');
    $offer = Offer::create($offerdata);
    if ($offer) {
      $detaildata = $request->except('_token', 'offer_project_code', 'offer_project_name_tr', 'offer_project_name_en', 'user_id', 'offer_date');


      foreach ($detaildata['detail'] as $dt) {

        $dt['offer_id'] = $offer->id;

        $detail = OfferDetail::create($dt);
      }
      return Redirect()->route('offer_index')->with('success', 'Teklif Başarıyla Eklendi');
    }


  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Offer $offer
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    $offerdata = Offer::all();

    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "Teklif Listesi"]
    ];
    return view('pages.offer-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs],
      compact('offerdata'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Offer $offer
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $offeredit = Offer::find($id);
    return view('pages.offer-edit', compact('offeredit'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Offer $offer
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->except('_token');
    Offer::find($id)->update($data);
    return Redirect()->route('offer_index')->with('success', 'Teklif Güncellemesi Başarılı');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Offer $offer
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      Offer::find($id)->delete();
    return Redirect()->route('offer_index')->with('success', 'Teklif Başarıyla Silindi');
  }

  public function detail($id)
  {
    $offerid=$id;
    $data = OfferDetail::whereOfferId($id)->get();
//      $e = $this->OfferDetail->offer_detail_page($id);
//      $data = $e['data'];
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "Seçili Teklifin Proje Detayı"]
    ];
    return view('pages.offer-detail-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('data','offerid'));
  }

  public function detailedit($id)
  {
    $detailedit = OfferDetail::find($id);
    return view('pages.offer-detail-edit', compact('detailedit'));

  }

  public function detailupdate(Request $request, $id)
  {
    $detaildata = $request->except('_token');
    OfferDetail::find($id)->update($detaildata);

    return Redirect()->route('offer_index')->with('success', 'Teklif Proje Detay Güncellemesi Başarılı');

  }

  public function detailadd($offer_id)
  {
    $offerdt=$offer_id;
    $offerdtadd = OfferDetail::whereOfferId($offer_id)->get();
    return view('pages.offer-detail-add', compact('offerdtadd','offerdt'));
  }

  public function detailstore(Request $request)
  {
    $detailstore = $request->except('_token');
    $dt = OfferDetail::create($detailstore);
    return Redirect()->route('offer_index')->with('success', 'Teklif Proje Detay Eklenmesi Başarılı');
  }
  public function detaildestroy($id)
  {
    OfferDetail::find($id)->delete();
    return Redirect()->route('offer_index')->with('success', 'Teklif Proje Detay Başarıyla Silindi');
  }
}
