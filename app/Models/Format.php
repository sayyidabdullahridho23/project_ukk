<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $table = 'tbl_format';
    protected $primaryKey = 'id_format';
    public $timestamps = true;
    
    protected $fillable = [
        'kode_format',
        'format',
        'keterangan'
    ];

    public function getNamaFormatAttribute()
    {
        return $this->format;
    }

    public function pustaka()
    {
        return $this->hasMany(Pustaka::class, 'id_format', 'id_format');
    }
}