<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSoalList extends Model
{
    use HasFactory;
    protected $table = 'tbl_ujian_soal';
    protected $fillable = [
        'soal_id',
        'ujian_id',
        'kebenaran',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
    
}
