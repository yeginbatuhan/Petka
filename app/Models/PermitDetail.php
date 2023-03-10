<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitDetail extends Model
{
    use HasFactory;
    protected $guarded=[];
  protected $hidden=['id','created_at','updated_at'];
  public function permit()
  {
    return $this->belongsTo(Permit::class);
  }

  public function permit_detail_page ($id)
  {
    $permitd=Permit::find($id);
    $data=['details'=>$permitd->permit_details,'permit_name'=>$permitd->permit_name];

    return ['message'=>'İzin Detayı Listelenmiştir.','status'=>true,'data'=>$data];
  }
}
