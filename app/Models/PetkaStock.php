<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;
class PetkaStock extends Model
{
  use HasFactory,Multitenantable;
  protected $guarded = [];
  protected $hidden = ['user_id','created_at','updated_at'];
  public function petka_stock_details()
  {
    return $this->hasMany(PetkaStockDetail::class);
  }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  public function petka_stock_page()
  {
    $ptstocks = PetkaStock::whereIsActive(1)->get();
    $data = [];
    foreach ($ptstocks as $stock) {
      if ($stock->petka_stock_details()->exists()) {
        $data[] = collect($stock)->put('detail', true)->put('user_name', $stock->user->name);
      } else {
        $data[] = collect($stock)->put('detail', false)->put('user_name', $stock->user->name);
      }
    }

    return ['message' => 'Petka Stokları', 'status' => true, 'data' => $data];
  }

}
