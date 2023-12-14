<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_contents';

    // protected $fillable = [
    //     'pertanyaan',
    //     'kategori',
    //     'opsi_a',
    //     'opsi_b',
    //     'opsi_c',
    //     'opsi_d',
    //     'jawaban',
    // ];    
}
