<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table = 'tbl_ujian';

    protected $fillable = [
        'user_id',
        'kategori',
        'status',
        'timer',
        'score',
        'hasil',
        'nilai_area1',
        'nilai_area2',
        'nilai_area3',
        'nilai_area9',
        'status_area1',
        'status_area2',
        'status_area3',
        'status_area9',
        'timer_area1',
        'timer_area2',
        'timer_area3',
        'timer_area9',
    ];    
}
