<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use App\Models\User;
use Illuminate\Http\Request;

class OngoingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
  {
    $going= new Ongoing;

    return response()->json($going->ongoing_page(), 200);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function create()
  {
    $data=User::where('user_type','=','1')->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["link" => route('ongoing_index'), "name" => "Devam Eden Projeler"],["name" => "Devam Eden Proje Ekle"]
    ];
    return view('pages.ongoing-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],compact('data'));
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
      'user_id'=>'required',

    ],
      [
        'user_id.required' => 'Bu Alan Boş Olamaz ',

      ]);

    $data=$request->except('_token');

    $going=Ongoing::create($data);
    return Redirect()->back()->with('success', 'Devam Eden Proje Eklendi');
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ongoing  $ongoing
     * @return \Illuminate\Http\Response
     */
  public function show()
  {
    $going=Ongoing::all();

    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["name" => "Devam Eden Proje Listesi"]
    ];
    return view('pages.ongoing-index',
      ['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],
      compact('going'));
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ongoing  $ongoing
     * @return \Illuminate\Http\Response
     */
  public function edit($id)
  {
    $goinguser=User::where('user_type','=','1')->get();
    $goingedit=Ongoing::find($id);
    return view('pages.ongoing-edit',compact('goingedit','goinguser'));
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ongoing  $ongoing
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, $id)
  {
    $data=$request->except('_token');
    Ongoing::find($id)->update($data);
    return Redirect()->route('ongoing_index')->with('success', 'Devam Eden Proje Güncellemesi Başarılı');
  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ongoing  $ongoing
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
  {
    Ongoing::find($id)->delete();
    return Redirect()->route('ongoing_index')->with('success', 'Devam Eden Proje Silindi');
  }
}
