<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSoalRequest;
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

    public function create()
    {
        $data['type_menu'] = 'soal';
        return view('soal.form', $data);
    }

    public function store(StoreSoalRequest $request)
    {
        $data = $request->all();
        \App\Models\Soal::create($data);
        return redirect()->route('soals.index')->with('success', 'Data successfully created');
    }    

    public function edit($id)
    {
        $data['type_menu'] = 'soal';
        $data['soal'] = \App\Models\Soal::findOrFail($id);
        return view('soal.form', $data);
    }   

    public function destroy($id)
    {
        // dd('Data -'.$id);
        // $soal = DB::table('tbl_banksoal')->where('id', $id)->delete();
        // DB::delete('delete from tbl_banksoal where id = ?',[$id]);
        DB::table('tbl_banksoal')->where('id', $id)->delete();
        return redirect()->back()->withErrors('Data successfully deleted');
        // if($soal){
        //     // dd('ok -'.$soal);
        //     return redirect()->route('soal.index')->with('success', 'Data successfully deleted');
        // }else{
        //     // dd('not ok -'.$soal);
        //     return redirect()->back()->withErrors('Data successfully deleted');
        // }
    }     
}
