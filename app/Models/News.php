<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class News extends Model
{
    use HasFactory , Multitenantable;
    protected $guarded=[];
    protected $hidden=['user_id','id'];

  public function news_page(){
    $datapage=News::whereIsActive(1)->get(['new_title','new_image','new_text']);

    return ['message'=>'Bülten','status'=>true,'data'=>$datapage];
  }







}
