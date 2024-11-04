<?php

namespace App\Exports;
use App\Models\Asset;
use App\Models\Asset_history;
use App\Models\Divisi;
use App\Models\Cabang;
use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;

class ExportAsset implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $cabang;
    protected $divisi;

    public function __construct(Request $request)
    {
        $this->cabang = $request->cabang;
        $this->divisi = $request->divisi;
    }

    public function query()
    {
        $query = Asset::query()
            ->select('asset.kode_asset','asset.tanggal_beli','asset.tanggal_pindah','asset.id_kategori', 'asset.nama_asset', 'asset.merk', 'asset.sfesifikasi', 'asset.kelengkapan', 'pegawai.nama as nama_pegawai', 'divisi.divisi', 'cabang.nama as nama_cabang', 'asset.lokasi', 'asset.kondisi', 'asset.keterangan_kondisi', 'asset.status', 'asset.tgl_musnah')
            ->join('pegawai', 'pegawai.kode_pegawai', '=', 'asset.kode_pegawai')
            ->join('cabang','asset.kode_cabang','=','cabang.kode')
            ->join('divisi','asset.kode_divisi','=','divisi.kode');

            if($this->cabang == '0' && $this->divisi == '0'){
            
            } elseif ($this->cabang == '0' && $this->divisi > '0'){

                $query->where('asset.kode_divisi', $this->divisi);

            } elseif ($this->cabang > '0' && $this->divisi == '0'){

                $query->where('asset.kode_cabang', $this->cabang);

            } elseif ($this->cabang > '0' && $this->divisi > '0'){
                $query->where('asset.kode_divisi', $this->divisi)
                      ->where('asset.kode_cabang', $this->cabang);
            }
        return $query;
    }

    public function headings(): array
    {
        return [
            'Kode Asset',
            'Tanggal Beli',
            'Tanggal Pindah',
            'Kategori',
            'Nama Asset',
            'Merk',
            'Spesifikasi',
            'Kelengkapan',
            'Pengguna',
            'Divisi',
            'Cabang',
            'Lokasi',
            'Kondisi',
            'Keterangan',
            'Status',
            'Tanggal Musnah',
        ];
    }
}
