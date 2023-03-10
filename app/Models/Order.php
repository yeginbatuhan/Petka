<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class Order extends Model
{
  use HasFactory, Multitenantable;

  protected $guarded = [];
  protected $hidden = ['user_id','created_at','updated_at','is_active'];
  public function order_details()
  {
    return $this->hasMany(OrderDetail::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public function order_page()
  {
    $orderspage = Order::all();
    $data = [];
    foreach ($orderspage as $page) {
      // belongsto tek gitme      $data['user_name']=$page->user->name;
      if ($page->order_details()->exists()) {
        $sum_remaining=0;
        $sum_order_detail_order=0;
        foreach ($page->order_details as $dtl)
        {
          $sum_remaining+=$dtl->order_detail_remaining;
          $sum_order_detail_order+=$dtl->order_detail_order;
        }
        if ($sum_remaining==0)
        {
          //completed
//     foreach ile     $data[]=collect($page)->put('user_name',$page->user->name);
          $data[] = collect($page)->put('user_name',$page->user->name)->put('detail', true)->except('order_details')
            ->put('status',2);

        }else if ($sum_remaining==$sum_order_detail_order){
          //waiting

          $data[] = collect($page)->put('user_name',$page->user->name)->put('detail', true)->except('order_details')
            ->put('status',1);

        }else{
          //continues

          $data[] = collect($page)->put('user_name',$page->user->name)->put('detail', true)->except('order_details')
            ->put('status',1);

        }
      } else {

        $data[] = collect($page)->put('user_name',$page->user->name)->put('detail', false);

      }

    }


    return ['message' => 'Siparişler', 'status' => true, 'data' => $data];
  }


}
