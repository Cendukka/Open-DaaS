<?php

namespace App\Imports;

use App\material;
use Maatwebsite\Excel\Concerns\ToModel;

class materialexport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new material([

        ]);
    }
}
