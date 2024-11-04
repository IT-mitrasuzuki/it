<?php

namespace App\Exports;
use App\Models\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUnit implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Unit::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Tanggal Masuk',
            'Merk',
            'Tipe',
            'No Mesin',
            'Warna',
            'No Polisi',
            'Tahun',
            'Pemilik',
            'Lokasi',
            'Pemakai',
            'Tanggal STNK',
            'Reminder',
            'Keterangan',
            'Email 1',
            'Email 2',
            'Email 3',
            'Email 4',
            'Tanggal dibuat',
            'Coorporate',
            'Pengguna',
        ];
    }
}
