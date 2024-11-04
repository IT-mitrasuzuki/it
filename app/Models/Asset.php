<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "asset";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_asset';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_asset',           // Asset code
        'tanggal_beli',         // Purchase date
        'tanggal_pindah',       // Transfer date
        'id_kategori',          // Category ID
        'nama_asset',           // Asset name
        'merk',                 // Brand
        'spesifikasi',          // Specifications
        'kelengkapan',          // Completeness
        'kode_pegawai',         // Employee code
        'kode_divisi',          // Division code
        'kode_cabang',          // Branch code
        'lokasi',               // Location
        'keterangan_kondisi',   // Condition description
        'kondisi',              // Condition
        'tahun',                // Year
        'foto',                 // Photo
        'status',               // Status
        'tgl_musnah',           // Disposal date
        'dibuat',               // Created by
        'tgl_buat',             // Creation date
        'diupdate',             // Updated by
        'tgl_update',           // Update date
        'expire_date',          // Expiry date
    ];

    /**
     * Boot function to handle events during model lifecycle.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->kode_asset = self::generateCustomNumber();
        });
    }

    /**
     * Generate a custom asset code.
     *
     * @return string
     */
    public static function generateCustomNumber()
    {
        $number = str_pad(self::getNextNumber(), 9, '0', STR_PAD_LEFT);
        $month = now()->format('m');
        $year = now()->format('Y');

        return $number . $month . $year;
    }

    /**
     * Get the next asset number.
     *
     * @return int
     */
    protected static function getNextNumber()
    {
        $lastOrder = self::orderBy('id_asset', 'desc')->first();
        if (!$lastOrder) {
            return 1;
        }
        $lastNumber = substr($lastOrder->kode_asset, 0, 9);

        return (int) $lastNumber + 1;
    }
}

