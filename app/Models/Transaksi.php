<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tgl_transaksi';
    protected $primaryKey = 'id_transaksi';
    
    protected $fillable = [
        'id_pustaka',
        'id_anggota',
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_pengembalian',
        'fp',
        'keterangan',
        'status_approval',
        'reject_reason',
        'denda_rusak',
        'denda_hilang'
    ];

    protected $dates = [
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_pengembalian'
    ];

    public function pustaka()
    {
        return $this->belongsTo(Pustaka::class, 'id_pustaka', 'id_pustaka');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }
} 