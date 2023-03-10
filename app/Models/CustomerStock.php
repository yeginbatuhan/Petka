<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;
class CustomerStock extends Model
{
    use HasFactory, Multitenantable;
  protected $guarded = [];
  protected $hidden = ['user_id','created_at','updated_at'];
  public function customer_stock_details()
  {
    return $this->hasMany(CustomerStockDetail::class);
  }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  public function customer_stock_page()
  {
    $stocks = CustomerStock::whereIsActive(1)->get();
    $data = [];
    foreach ($stocks as $stock) {
      if ($stock->customer_stock_details()->exists()) {
        $data[] = collect($stock)->put('detail', true)->put('user_name', $stock->user->name);
      } else {
        $data[] = collect($stock)->put('detail', false)->put('user_name', $stock->user->name);
      }
    }

    return ['message' => 'Müşteri Numuneleri', 'status' => true, 'data' => $data];
  }

}
