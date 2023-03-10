<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStartRow;
class UsersImport implements ToModel, WithStartRow
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
      return new User([

        'user_code'=>$row[0],
        'name'     => $row[1],
        'email'    => $row[2],
        'user_type'=>$row[3],
        'phone_number'=>$row[4],
        'password' => Hash::make(Str::random(6)),
      ]);
    }
}
