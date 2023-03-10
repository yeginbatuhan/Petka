<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;
use Illuminate\Support\Facades\DB;
class Permit extends Model
{
  use HasFactory, Multitenantable;

  protected $guarded = [];
  protected $hidden = ['user_id', 'created_at', 'updated_at', 'is_active'];

  public function permit_details()
  {
    return $this->hasMany(PermitDetail::class,'permit_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function permit_user()
  {
    $data = Permit::with('user')->select('user_id', DB::raw("SUM(CAST(permit_total_days as int)) as total"))
      ->groupBy('user_id')
      ->get();

    return ['message' => 'İzin Listesi', 'status' => true, 'data' => $data];

  }

  public static function detail_total($id)
  {
    $permitpage = Permit::whereUserId($id)->get();
    $total=0;
    foreach ($permitpage as $page) {
      $total += $page->permit_details->sum('permit_detail_use_day');
    }
   return $total;
  }

  public function permit_page()
  {
    $permitpage = Permit::orderBy('permit_year', 'ASC')->get();

    $data = [];
    foreach ($permitpage as $page) {

      // belongsto tek gitme      $data['user_name']=$page->user->name;

      $remaining = $page->permit_total_days;
      $used = 0;
      foreach ($page->permit_details as $dtl) {
        $remaining -= $dtl->permit_detail_use_day;
        $used += $dtl->permit_detail_use_day;
      }

      //completed
//     foreach ile     $data[]=collect($page)->put('user_name',$page->user->name);
      $data[] = collect($page)
        ->put('user_name', $page->user->name)
        ->put('detail', true)
        ->except('permit_details')
        ->put('status', 2)
        ->put('remaining', $remaining)
        ->put('total_used', $used);

    }
    //total day start
    $general_total_days = 0;
    $general_used_days = 0;
    $general_remaining_days = 0;

    foreach ($data as $tdata) {
      $general_total_days += $tdata['permit_total_days'];
      $general_used_days += $tdata['total_used'];
      $general_remaining_days += $tdata['remaining'];
    }

    $total = [
      'general_total_days' => $general_total_days,
      'general_used_days' => $general_used_days,
      'general_remaining_days' => $general_remaining_days
    ];
    //total day end
    return ['message' => 'İzin Listesi', 'status' => true, 'data' => $data, 'total' => $total];
  }

























  // protected $connection = 'ptkSrv';
  // protected $table = 'TBLTEKLIF';


  /* public function permit_page()
   {
     $data=Permit::whereIsActive(1)->get();

     return ['message'=>'İzin Durumu','status'=>true,'data'=>$data];
   }*/
}
