<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongoing extends Model
{
  use HasFactory;

  protected $guarded=[];
  protected $hidden=['user_id','is_active','id','created_at','updated_at'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function ongoing_page()
  {
    $data=Ongoing::whereIsActive(1)->get();
    $page=[];
foreach ($data as $dt)
{
  $page[]= collect($dt)->put('user_name',$dt->user->name);
}
    return ['message'=>'Devam Eden Projeler','status'=>true,'data'=>$page];
  }
}
