<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded=[];
  protected $hidden=['id'];
  public function promotion_page()
  {
    $data=Promotion::all();

    return ['message'=>'Tanıtım','status'=>true,'data'=>$data];
  }
}
