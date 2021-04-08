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
            $zone = Zone::firstOrCreate(array('name'=>$row[5]));
            $slug = Str::slug($row[2]);
            User::create([
                'email'=>$slug.'@aptma.org',
                'name'=>$row[2],
                'username'=>$slug.'-'.strtolower(Str::random(2)),
                'email_verified'=>1,
                'phone'=>$row[3],
                'fax'=>$row[4],
                'zone_id'=>$zone->id,
                'password'=>Hash::make('1234'),
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
