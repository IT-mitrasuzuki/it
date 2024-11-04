<?php

namespace App\Exports;

use App\Models\security;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class SecurityExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
        
   
    
    public function query()
    {
        
        return security::query()->where('cabang',);
        // ->where('kode_cabang', $cabang)
        // ->get();
    }
}
