<?php

namespace App\Exports;
use App\Models\Sewa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSewa implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sewa::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Nama Pengguna',
            'Objek',
            'lama',
            'Tanggal Mulai',
            'Tanggal Berakhir',
            'Kontrak Ke',
            'Nilai Sewa',
            'Pph Sewa',
            'Keterangan Pph',
            'PIC',
            'Nama Pemilik',
            'No Telepon',
            'Ktp Pemilik',
            'Keterangan',
            'Email 1',
            'Email 2',
            'Email 3',
            'Email 4',
            'Email 5',
        ];
    }
}
