<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferDetail extends Model
{
    use HasFactory;
  protected $guarded=[];
  protected $hidden=['id','created_at','updated_at'];
  public function offer_details()
  {
    return $this->belongsTo(Offer::class);
  }
  public function offer_detail_page ($id){
    $offerd=Offer::find($id);
    return ['message'=>'Teklif İçeriği Listelenmiştir.','status'=>true,'data'=>$offerd->offer_details];
  }
//  public static function getOfferId($data)
//  {
//    $offer_id=  OfferDetail::find($data)->offer_id;
//    return OfferDetail::whereOfferId($offer_id)->get();
//  }
}
