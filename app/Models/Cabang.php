<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Cabang Model
 * 
 * This model represents branches of a company.
 */
class Cabang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cabang';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',              // Nama cabang
        'sn',                // Serial number
        'kode_perusahaan',   // Kode perusahaan
        'dibuat',            // Dibuat oleh
        'tgl_buat',          // Tanggal pembuatan
        'diupdate',          // Diupdate oleh
        'tgl_update',        // Tanggal update terakhir
    ];
}

