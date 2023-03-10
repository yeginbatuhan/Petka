<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $hidden=['id','created_at','updated_at'];

  public function order_details()
  {
    return $this->belongsTo(Order::class);
  }

  public function order_detail_page ($id)
  {
    $orderd=Order::find($id);
    $data=['details'=>$orderd->order_details,'order_detail_title_tr'=>$orderd->order_detail_title_tr,
      'order_detail_title_en'=>$orderd->order_detail_title_en];

    return ['message'=>'Sipariş İçeriği Listelenmiştir.','status'=>true,'data'=>$data];
  }

}
