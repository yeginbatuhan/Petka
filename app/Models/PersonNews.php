<?php

namespace App\Models;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonNews extends Model
{
    use HasFactory,Multitenantable;
  protected $guarded=[];
  protected $hidden=['user_id','id'];

  public function person_news_page(){
    $datapage=PersonNews::whereIsActive(1)->get(['person_new_title','person_new_image','person_new_text']);

    return ['message'=>'Bülten','status'=>true,'data'=>$datapage];
  }

}
