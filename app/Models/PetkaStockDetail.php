<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetkaStockDetail extends Model
{
  use HasFactory;
protected $guarded=[];
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function petka_stock_details()
  {
    return $this->belongsTo(PetkaStock::class);
  }

  public function petka_stock_detail_page($id)
  {
    $detail = PetkaStock::find($id);
    return ['message'=>'Stok İçeriği Listelenmiştir.','status'=>true,'data'=>$detail->petka_stock_details];
  }
}
