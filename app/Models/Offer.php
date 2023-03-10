<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;
class Offer extends Model
{
    use HasFactory,Multitenantable;
  protected $guarded = [];
  protected $hidden = ['user_id','created_at','updated_at'];
  public function offer_details()
  {
    return $this->hasMany(OfferDetail::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function offer_page()
  {
    $offers = Offer::whereIsActive(1)->get();
    $data = [];
    foreach ($offers as $offer) {
      if ($offer->offer_details()->exists()) {
        $data[] = collect($offer)->put('detail', true)->put('user_name', $offer->user->name);
      } else {
        $data[] = collect($offer)->put('detail', false)->put('user_name', $offer->user->name);
      }
    }

    return ['message' => 'Teklifler', 'status' => true, 'data' => $data];
  }
}
