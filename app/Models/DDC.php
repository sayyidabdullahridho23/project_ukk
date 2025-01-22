<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DDC extends Model
{
    protected $table = 'tbl_ddc';
    protected $primaryKey = 'id_ddc';
    public $timestamps = true;
    
    protected $fillable = [
        'kode_ddc',
        'ddc',
        'keterangan',
        'id_rak'
    ];

    public function getNamaDdcAttribute()
    {
        return $this->ddc;
    }

    public function pustaka()
    {
        return $this->hasMany(Pustaka::class, 'id_ddc', 'id_ddc');
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak', 'id_rak');
    }
}