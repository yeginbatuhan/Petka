<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Imports\OrdersImport;
use App\Imports\OrderDetailsImport;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orderpage= new Order();

      return response()->json($orderpage->order_page(), 200);
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
        ["link" => "/", "name" => "Home"],["link" => route('order_index'), "name" => "Proje Listesi"],["name" => "Proje Ekle"]
      ];
      return view('pages.order-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],compact('userid'));


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
        'order_detail_unit'=>'required'
      ],
        [
          'user_id.required' => 'Bu Alan Boş Olamaz ',
          'order_detail_unit.required' => 'Bu Alan Boş Olamaz ',
        ]);
        $orderdata=$request->except('_token','detail');
         $order=Order::create($orderdata);

//        $order=Order::insert([
//          'order_title'=>$request->order_title,
//          'order_code'=>$request->order_code,
//          'user_id'=>$request->user_id,
//          'created_at'=> Carbon::now()
//        ]);
//

      if ($order)
      {
        $detaildata=$request->except('_token','order_title_tr','order_title_en','order_code','user_id','order_date','order_delivery_date','order_detail_title_tr','order_detail_title_en');


        foreach ($detaildata['detail'] as $dt)
        {

          $dt['order_id']=$order->id;

          $detail=OrderDetail::create($dt);
        }
      return Redirect()->route('order_index')->with('success', 'Proje Eklendi');
      }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $orderdata=Order::all();

      $pageConfigs = ['pageHeader' => true];
      $breadcrumbs = [
        ["link" => "/", "name" => "Home"],["name" => "Proje Listesi"]
      ];
        return view('pages.order-index',
        ['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],
        compact('orderdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $orderedit=Order::find($id);
      return view('pages.order-edit',compact('orderedit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = $request->validate([

        'order_image'=>'mimes:jpeg,jpg,png',
      ],
        [

          'order_image.mimes' => 'Dosya türü yalnızca jpeg,jpg,png olmalıdır',
        ]);

      $old_image=$request->old_image;

      $order_img = $request->file('order_image');
      if ($order_img)
      {
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower(($order_img->getClientOriginalExtension()));
        $img_name = $name_gen . '.' . $img_ext;
        $up_location = 'images/petka/order/';
        $last_img = $up_location . $img_name;
        $order_img->move(public_path($up_location), $img_name);

         if($old_image==null)
         {
           Order::find($id)->update([
             'order_title_tr' => $request->order_title_tr,
             'order_title_en' => $request->order_title_en,
             'order_detail_title_tr'=>$request->order_detail_title_tr,
             'order_detail_title_en'=>$request->order_detail_title_en,
             'order_code' => $request->order_code,
             'order_image' => $last_img,
             'order_date' => $request->order_date,
             'order_delivery_date'=>$request->order_delivery_date
           ]);
         }else{
           unlink('public/'.$old_image);
           Order::find($id)->update([
             'order_title_tr' => $request->order_title_tr,
             'order_title_en' => $request->order_title_en,
             'order_detail_title_tr'=>$request->order_detail_title_tr,
             'order_detail_title_en'=>$request->order_detail_title_en,
             'order_code' => $request->order_code,
             'order_image' => $last_img,
             'order_date' => $request->order_date,
             'order_delivery_date'=>$request->order_delivery_date
           ]);
         }


        return Redirect()->route('order_index')->with('success', 'Proje Güncellemesi Başarılı');
      }else{
        Order::find($id)->update([
          'order_title_tr' => $request->order_title_tr,
          'order_title_en' => $request->order_title_en,
          'order_detail_title_tr'=>$request->order_detail_title_tr,
          'order_detail_title_en'=>$request->order_detail_title_en,
          'order_code' => $request->order_code,
          'order_date' => $request->order_date,
          'order_delivery_date'=>$request->order_delivery_date

        ]);
        return Redirect()->route('order_index')->with('success', 'Proje Güncellemesi Başarılı');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $image=Order::find($id);
      $old_image=$image->order_image;
      if ($old_image==null)
      {
        Order::find($id)->delete();
        return Redirect()->back()->with('Success', 'Proje Ve Proje Detayı Silindi.');
      }else{
        unlink('public/'.($old_image));
        Order::find($id)->delete();
        return Redirect()->back()->with('Success', 'Proje Ve Proje Detayı Silindi.');
      }



    }
    public function detailedit($id)
    {
      $detailedit=OrderDetail::find($id);
        return view('pages.order-detail-edit',compact('detailedit'));

    }
  public function detailupdate(Request $request, $id)
  {
    $detaildata=$request->except('_token');
    OrderDetail::find($id)->update($detaildata);

    return Redirect()->route('order_index')->with('success', 'Proje Detay Güncellemesi Başarılı');

  }

  public function detail( $id)
  {
    $orderid=$id;
    $orderdetaildata=OrderDetail::whereOrderId($id)->get();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["name" => "Seçili Proje Detayı"]
    ];
    return view('pages.order-detail-index',
      ['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],compact('orderdetaildata','orderid'));



  }
  public function detaildelete($id)
  {
    OrderDetail::find($id)->delete();
    return Redirect()->back()->with('Success', 'Proje Detayu Silindi');
  }

  public function import(Request $request)
  { $data = $request->validate([
    'excel_file' => 'required|mimes:xlsx'
  ],
    [
      'excel_file.required' => 'Lütfen Dosyayı Yükleyin ',
      'excel_file.mimes' => 'Dosya türü yalnızca xlsx olmalıdır',
    ]);
    $orderexcel = $request->file('excel_file');
    Excel::import(new OrdersImport, $orderexcel);

    return Redirect('/orders')->with('Success', 'Proje Eklendi');
  }
  public function excelshow()
  {

    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["name" => "Proje Excel Ekleme"]
    ];
    return view('pages.orders-excel-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);

  }
  public function importdetail(Request $request)
  {
    $data = $request->validate([
      'excel_file' => 'required|mimes:xlsx'
    ],
      [
        'excel_file.required' => 'Lütfen Dosyayı Yükleyin ',
        'excel_file.mimes' => 'Dosya türü yalnızca xlsx olmalıdır',
      ]);

    $orderdetailexcel = $request->file('excel_file');
    Excel::import(new OrderDetailsImport, $orderdetailexcel);

    return Redirect('/orders')->with('Success', 'Proje Detayı Eklendi');
  }
  public function exceldetail()
  {

    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["name" => "Proje Excel Ekleme"]
    ];
    return view('pages.order-details-excel-create',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);

  }
  public function downloadone()
  {
    return response()->download(public_path('excel/orders/anayeni.xlsx'));
  }
  public function downloadtwo()
  {
    return response()->download(public_path('excel/orders/detail/detaynew.xlsx'));
  }

  public function formdet($order_id)
  {
    $orderid=$order_id;
    $order=Order::all();
    $pageConfigs = ['pageHeader' => true];
    $breadcrumbs = [
      ["link" => "/", "name" => "Home"],["name" => "Proje Detay Ekleme"]
    ];
    return view('pages.order-details-add',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs],compact('order','orderid'));
  }
  public function formadd(Request $request)
  {
    $data = $request->validate([

      'order_detail_unit'=>'required',

    ],
      [

        'order_detail_unit.required' => 'Bu Alan Boş Bırakılamaz',
       

      ]);
    $orderdata=$request->except('_token');
    OrderDetail::create($orderdata);
    return Redirect()->route('order_index')->with('success', 'Proje Detay Eklendi');
  }
}
