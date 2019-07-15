<?php

namespace App\Imports;

use App\user;
use Maatwebsite\Excel\Concerns\ToModel;

class user_import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new user([

            'microlocation_name'    => $row ["microlocation_name"],
            'user_typename'         => $row ["user_typename"],
            'last_name'             => $row ["last_name"],
            'first_name'            => $row ["first_name"],
            'email'                 => $row ["email"],
            'username'              => $row ["username"]


        ]);
    }
}
