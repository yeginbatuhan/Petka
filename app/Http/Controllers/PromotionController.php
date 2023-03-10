<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $page= new Promotion();

    return response()->json($page->promotion_page(), 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["link" => route('promotion_index'), "name" => "Tanıtım"],["name" => "Tanıtım Ekle"]
    ];
    return view('pages.promotion-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $dt = $request->validate([
      'promotion_pdf' => 'required|mimes:pdf',
    ],
      [
        'promotion_pdf.required' => 'Bu Alan Boş Olamaz ',
        'promotion_pdf.mimes' => 'Sadece PDF yükleyebilirsiniz ',
      ]);
    $pdf = $request->file('promotion_pdf');

    $name_gen = hexdec(uniqid());
    $pdf_ext = strtolower(($pdf->getClientOriginalExtension()));
    $pdf_name = $name_gen . '.' . $pdf_ext;
    $up_location = 'docs/pdf/';
    $last_pdf = $up_location . $pdf_name;
    $pdf->move(public_path($up_location), $pdf_name);
    Promotion::insert([
      'promotion_title' => $request->promotion_title,
      'promotion_pdf' => $last_pdf,
    ]);
/*    $data = $request->except('_token');
    Promotion::create($data);*/
    return Redirect()->route('promotion_index')->with('success', 'Tanıtım Eklendi');
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Promotion $promotion
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    $pdata = Promotion::all();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"], ["name" => "Tanıtım"]
    ];
    return view('pages.promotion-index',
      ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs],
      compact('pdata'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Promotion $promotion
   * @return \Illuminate\Http\Response
   */
  public function edit(Promotion $promotion)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\Promotion $promotion
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Promotion $promotion)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Promotion $promotion
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $pdf=Promotion::find($id);
    $old_pdf=$pdf->promotion_pdf;
    unlink('public/'.($old_pdf));
    Promotion::find($id)->delete();
    return Redirect()->route('promotion_index')->with('success', 'Tanıtım Silindi');
  }
}
