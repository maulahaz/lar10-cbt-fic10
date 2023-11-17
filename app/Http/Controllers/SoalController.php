<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $data['type_menu'] = 'soal';
        return view('soal.index', $data);
    }

    public function list()
    {
        $data['type_menu'] = 'soal';
        return view('soal.list', $data);
    }
}
