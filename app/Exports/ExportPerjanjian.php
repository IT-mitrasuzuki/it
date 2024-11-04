<?php

namespace App\Exports;
use App\Models\Perjanjian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportPerjanjian implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Perjanjian::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Nama Pengguna',
            'Objek',
            'lama',
            'PIC',
            'Tanggal Kontrak',
            'Tanggal Berakhir',
            'Hp',
            'Telpon',
            'Keterangan',
            'Email 1',
            'Email 2',
            'Email 3',
            'Email 4',
            'Perusahaan',
            'Coorporate',
            'Pengguna',
        ];
    }
}
