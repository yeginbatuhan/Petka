<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Carbon;
class OrdersImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
  public function startRow(): int
  {
    return 2;
  }
    public function model(array $row)
    {
      $order_order_date = empty($row[4]) ? $row[4] : Carbon::instance(Date::excelToDateTimeObject($row[4]));
      $order_delivery_date= empty($row[7]) ? $row[7] : Carbon::instance(Date::excelToDateTimeObject($row[7]));
        return new Order([
          'user_id'     => $row[0],
          'order_code'  => $row[1],
          'order_title_tr' => $row[2],
          'order_title_en'=>$row[3],
          'order_date'=>$order_order_date,
          'order_detail_title_tr'=>$row[5],
          'order_detail_title_en'=>$row[6],
          'order_delivery_date'=>$order_delivery_date
        ]);
    }
}
