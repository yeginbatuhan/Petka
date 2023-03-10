<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $new= new News();

      return response()->json($new->news_page(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $userid=User::where('user_type','=','1')->get();
      $pageConfigs = ['pageHeader' => true];
      $breadcrumbs = [
        ["link" => "/", "name" => "Home"],["link" => route('new_index'), "name" => "Bülten Listesi"],["name" => "Bülten Ekle"]
      ];
      return view('pages.news-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],compact('userid'));

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
        'new_image'=>'required|mimes:jpeg,jpg,png',
        'new_text'=>'required',
      ],
        [
          'user_id.required' => 'Bu Alan Boş Olamaz ',
          'new_image.mimes' => 'Dosya türü yalnızca jpeg,jpg,png olmalıdır',
          'new_text.required' => 'Bu Alan Boş Olamaz',
        ]);
      $new_images = $request->file('new_image');
      $name_gen = hexdec(uniqid());
      $img_ext = strtolower(($new_images->getClientOriginalExtension()));
      $img_name = $name_gen . '.' . $img_ext;
      $up_location = 'images/petka/news/';
      $last_img = $up_location . $img_name;
      $new_images->move(public_path($up_location), $img_name);;
      News::insert([
        'user_id'=>$request->user_id,
        'new_title' => $request->new_title,
        'new_image' => $last_img,
        'new_text' => $request->new_text,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
      ]);

      return Redirect()->back()->with('success','Seçili Müşteriye Bülten Kayıtı Yapıldı');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $newsdata=News::all();

      $pageConfigs = ['pageHeader' => true];
      $breadcrumbs = [
        ["link" => "/", "name" => "Home"],["name" => "Müşteri Bülten Listesi"]
      ];
      return view('pages.news-index',
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
      $userid=User::where('user_type','=','1')->get();
      $newsedit=News::find($id);
      return view('pages.news-edit',compact('newsedit','userid'));
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
      $data = $request->validate([
        'new_image'=>'required|mimes:jpeg,jpg,png',
        'new_text'=>'required',
      ],
        [
          'new_image.mimes' => 'Dosya türü yalnızca jpeg,jpg,png olmalıdır',
          'new_text.required' => 'Bu Alan Boş Olamaz',
        ]);

      $old_image=$request->old_image;

      $new_img = $request->file('new_image');
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
          News::find($id)->update([

            'new_title' => $request->new_title,
            'new_image' => $last_img,
            'new_text' => $request->new_text,
            'updated_at'=>Carbon::now()
          ]);
        }else{
          unlink('public/'.$old_image);
          News::find($id)->update([

            'new_title' => $request->new_title,
            'new_image' => $last_img,
            'new_text' => $request->new_text,
            'updated_at'=>Carbon::now()
          ]);
        }


        return Redirect()->route('new_index')->with('success', 'Bülten Güncellemesi Başarılı');
      }else{
        News::find($id)->update([

          'new_title' => $request->new_title,
          'new_text' => $request->new_text,
          'updated_at'=>Carbon::now()
        ]);
        return Redirect()->route('new_index')->with('success', 'Bülten Güncellemesi Başarılı');
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
      $image=News::find($id);
      $old_image=$image->new_image;
      if ($old_image==null)
      {
        News::find($id)->delete();
        return Redirect()->back()->with('Success', 'Bülten Silindi.');
      }else{
        unlink('public/'.($old_image));
        News::find($id)->delete();
        return Redirect()->back()->with('Success', 'Bülten Silindi.');
      }
    }

}
