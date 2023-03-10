<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerStockDetail extends Model
{
    use HasFactory;
  protected $guarded=[];
  protected $hidden = ['id', 'created_at', 'updated_at'];
  public function customer_stock_details()
  {
    return $this->belongsTo(CustomerStock::class);
  }

  public function customer_stock_detail_page($id)
  {
    $detail = CustomerStock::find($id);
    return ['message'=>'Numune İçeriği Listelenmiştir.','status'=>true,'data'=>$detail->customer_stock_details];
  }
}
