<?php

namespace App\Exports;
use App\Models\Asuransi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAsuransi implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Asuransi::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Masuk',
            'Nama Asuransi',
            'Tanggal Habis',
            'No Polisi',
            'Tahun',
            'No Mesin',
            'No Rangka',
            'Warna',
            'Tipe',
            'Merk',
            'Perusahaan',
            'Lokasi',
            'PIC',
            'Email 1',
            'Email 2',
            'Email 3',
            'Email 4',
            'Email 5',
            'Keterangan',
            'Status',
            'Tanggal Terjual',
            'No SPK',

        ];
    }
}
