<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function index(Request $request)
    {
        $data['type_menu'] = 'soal';
        $data['soals'] = DB::table('tbl_banksoal')
            ->when($request->input('pertanyaan'), function ($query, $name) {
                return $query->where('pertanyaan', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
            // dd($data);
        // return view('soal.index3', compact('data'));
        return view('soal.index', $data);
    }

    public function index1()
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
