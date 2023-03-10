<?php

namespace App\Imports;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Carbon;
use App\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class OrderDetailsImport implements ToModel,WithStartRow
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
      if (!empty($row[0])) {
        //$order_detail_order_date = empty($row[13]) ? $row[13] : Carbon::instance(Date::excelToDateTimeObject($row[13]));
        $order_detail_delivery_date = empty($row[14]) ? $row[14] : Carbon::instance(Date::excelToDateTimeObject($row[14]));
        return new OrderDetail([
          'order_id' => $row[0],
          'order_detail_code' => $row[1],
          'order_detail_name_tr' => $row[2],
          'order_detail_name_en' => $row[3],
          'order_detail_description_tr' => $row[4],
          'order_detail_stock' => $row[5],
          'order_detail_unit' => $row[6],
          'order_detail_unit_price' => $row[7],
          'order_detail_vat' => $row[8],
          'order_detail_discount' => $row[9],
          'order_detail_total' => $row[10],
          'order_detail_order' => $row[11],
          'order_detail_delivery' => $row[12],
          'order_detail_remaining' => $row[13],
          'order_detail_delivery_date' => $order_detail_delivery_date,
        ]);
      }
    }
}
