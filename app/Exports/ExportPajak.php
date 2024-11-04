<?php

namespace App\Exports;
use App\Models\Pajak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPajak implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pajak::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Jenis',
            'Lokasi',
            'Tanggal Mulai',
            'Tanggal Berakhir',
            'PIC',
            'Email 1',
            'Email 2',
            'Email 3',
            'Email 4',
            'Email 5',
            'Email 6',
            'Email 7',
        ];
    }
}
