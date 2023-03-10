<?php

namespace App\Http\Controllers;

use App\Models\PersonNews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PersonNewsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $new= new PersonNews();

    return response()->json($new->person_news_page(), 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $userid=User::where('user_type','=','2')->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["link" => route('person_new_index'), "name" => "Bülten Listesi"],["name" => "Bülten Ekle"]
    ];
    return view('pages.person-news-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],compact('userid'));

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
      'person_new_image'=>'required|mimes:jpeg,jpg,png',
      'person_new_text'=>'required',
    ],
      [
        'user_id.required' => 'Bu Alan Boş Olamaz ',
        'person_new_image.mimes' => 'Dosya türü yalnızca jpeg,jpg,png olmalıdır',
        'person_new_text.required' => 'Bu Alan Boş Olamaz ',
      ]);
    $new_images = $request->file('person_new_image');
    $name_gen = hexdec(uniqid());
    $img_ext = strtolower(($new_images->getClientOriginalExtension()));
    $img_name = $name_gen . '.' . $img_ext;
    $up_location = 'images/petka/news/';
    $last_img = $up_location . $img_name;
    $new_images->move(public_path($up_location), $img_name);;
    PersonNews::insert([
      'user_id'=>$request->user_id,
      'person_new_title' => $request->person_new_title,
      'person_new_image' => $last_img,
      'person_new_text' => $request->person_new_text,
      'created_at'=>Carbon::now(),
      'updated_at'=>Carbon::now(),
    ]);

    return Redirect()->back()->with('success','Seçili Personele Bülten Kayıtı Yapıldı');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\News  $news
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    $newsdata=PersonNews::all();

    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["name" => "Personel Bülten Listesi"]
    ];
    return view('pages.person-news-index',
      ['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],
      compact('newsdata'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\News  $news
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $userid=User::where('user_type','=','2')->get();
    $newsedit=PersonNews::find($id);
    return view('pages.person-news-edit',compact('newsedit','userid'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\News  $news
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $old_image=$request->old_image;

    $new_img = $request->file('person_new_image');
    if ($new_img)
    {
      $name_gen = hexdec(uniqid());
      $img_ext = strtolower(($new_img->getClientOriginalExtension()));
      $img_name = $name_gen . '.' . $img_ext;
      $up_location = 'images/petka/news/';
      $last_img = $up_location . $img_name;
      $new_img->move(public_path($up_location), $img_name);
      if($old_image==null)
      {
        PersonNews::find($id)->update([

          'person_new_title' => $request->person_new_title,
          'person_new_image' => $last_img,
          'person_new_text' => $request->person_new_text,
          'updated_at'=>Carbon::now()
        ]);
      }else{
        unlink('public/'.$old_image);
        PersonNews::find($id)->update([

          'person_new_title' => $request->person_new_title,
          'person_new_image' => $last_img,
          'person_new_text' => $request->person_new_text,
          'updated_at'=>Carbon::now()
        ]);
      }


      return Redirect()->route('person_new_index')->with('success', 'Bülten Güncellemesi Başarılı');
    }else{
      PersonNews::find($id)->update([

        'person_new_title' => $request->person_new_title,
        'person_new_text' => $request->person_new_text,
        'updated_at'=>Carbon::now()
      ]);
      return Redirect()->route('person_new_index')->with('success', 'Bülten Güncellemesi Başarılı');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\News  $news
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $image=PersonNews::find($id);
    $old_image=$image->new_image;
    if ($old_image==null)
    {
      PersonNews::find($id)->delete();
      return Redirect()->back()->with('Success', 'Bülten Silindi.');
    }else{
      unlink('public/'.($old_image));
      PersonNews::find($id)->delete();
      return Redirect()->back()->with('Success', 'Bülten Silindi.');
    }
  }

}
