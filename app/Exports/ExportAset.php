<?php

namespace App\Exports;
use App\Models\Aset;
use App\Models\aset_history;
use App\Models\Divisi;
use App\Models\Cabang;
use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAset implements FromQuery, WithHeadings
{
     /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $cabang;

    public function __construct(Request $request)
    {
        $this->cabang = $request->cabang;
    }

    public function query()
    {
        $query = Aset::query()
            ->select('aset.tgl_pembuatan','aset.kode','pegawai.nik','pegawai.nama as nama_peghawai', 'aset.lokasi', 'aset_detail.nama_item', 'aset_detail.spesifikasi', 'aset_detail.jumlah')
            ->join('aset_detail', 'aset_detail.id_parent', '=', 'aset.id')
            ->join('pegawai', 'pegawai.kode_pegawai', '=', 'aset.kode_pegawai');

            if($this->cabang == '0'){
            
            } elseif ($this->cabang > '0'){

                $query->where('aset.id_cabang', $this->cabang);

            } 
        return $query;
    }

    public function headings(): array
    {
        return [
            'Tanggal Pembelian',
            'Kode',
            'Nik',
            'Nama',
            'Lokasi',
            'Nama Item',
            'Spesifikasi',
            'Jumlah',
        ];
    }
}
