<?php

namespace App\Imports;

use App\User;
use App\Zone;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToCollection,WithStartRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $zone = Zone::where('name',$row[5])->first();
            $slug = Str::slug($row[2]);
            User::create([
                'email'=>$slug.'@aptma.com',
                'username'=>$slug.Str::random(5),
                'phone'=>$row[3],
                'fax'=>$row[4],
                'zone_id'=>$zone->id,
                'password'=>Hash::make('12345678'),
            ]);
        }

    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 5;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'unique:users,email',
            'username' => 'unique:users',
        ];
    }
}
