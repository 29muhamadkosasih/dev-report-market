<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class DatabaseUsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        return new User([
            'name' => $row[1],
            'username' => $row[2],
            'email' => $row[3],
            'no_hp' => $row[4],
            'departement_id' => $row[5],
            'jabatan_id' => $row[6],
            'password' => $row[7],
            'role_id' => $row[6]
        ]);
    }
}