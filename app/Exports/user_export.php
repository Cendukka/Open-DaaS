<?php

namespace App\Exports;

use App\company;
use App\user;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class user_export implements FromCollection, WithHeadings
{
    use Exportable;
    protected $company;
    public function __construct(company $company)
    {
        $this->company = $company;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $testcompany = $this->company;
        $user_data = DB::table('users')
                    ->where('user_company_id','=',$testcompany->company_id)
                    ->join('user_types', 'users.user_type_id', '=','user_types.user_type_id')
                    ->leftJoin('microlocations', 'users.user_microlocation_id', '=','microlocations.microlocation_id')
                    ->orderBy('user_id')
                    ->orderBy('user_microlocation_id')
                    ->orderBy('users.user_type_id')
                    ->orderBy('user_microlocation_id')
                    ->orderBy('user_id')
                    ->get();

        return $user_data;
    }
    public function headings(): array
    {
        return [
            'Microlokaatio',
            'Tyyppi',
            'Sukunimi',
            'Etunimi',
            'Käyttäjänimi',
        ];
    }
}
