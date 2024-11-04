<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Divisi Model
 *
 * This model represents divisions within an organization.
 */
class Divisi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'divisi';

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
        'divisi',       // Nama divisi
        'dibuat',       // Dibuat oleh
        'tgl_buat',     // Tanggal pembuatan
        'diupdate',     // Diupdate oleh
        'tgl_update',   // Tanggal update terakhir
        'manajer',      // Nama manajer divisi
        'email',        // Email kontak divisi
    ];
}

