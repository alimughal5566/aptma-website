<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $slug = Str::slug($row[2]);
        return new User([
            'email'=>$slug.'@aptma.com',
            'username'=>$slug,
            'phone'=>$row[3],
            'fex'=>$row[4],
            'password'=>'12345678',
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 5;
    }
}
