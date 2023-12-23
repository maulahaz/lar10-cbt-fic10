<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\UjianSoalList;
use App\Http\Resources\SoalResource;

class UjianController extends Controller
{

    public function create(Request $request)
    {
        //--get 20 soal angka random unique
        $soalArea1 = Soal::where('kategori', 'Area-1')->inRandomOrder()->limit(10)->get();
        $soalArea2 = Soal::where('kategori', 'Area-2')->inRandomOrder()->limit(10)->get();
        $soalArea3 = Soal::where('kategori', 'Area-3')->inRandomOrder()->limit(10)->get();
        $soalArea9 = Soal::where('kategori', 'Area-9')->inRandomOrder()->limit(10)->get();

        $ujian = Ujian::create([
            'user_id' => $request->user()->id
        ]);

        foreach ($soalArea1 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        foreach ($soalArea2 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        foreach ($soalArea1 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        foreach ($soalArea1 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        return response()->json([
            'message'   => 'Ujian berhasil dibuat',
            'data'      => $ujian
        ]);
    }

    public function getSoalUjianByKategori(Request $request)
    {
        $ujian = Ujian::where('user_id', $request->user()->id)->first();
        //--if $ujian By User empty, return empty:
        if(!$ujian){
            return response()->json([
                'message' => 'Failed : Ujian Not found',
                'data' => [],
            ]);
        }

        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->get();

        $soalId = $ujianSoalList->pluck('soal_id');

        $ujianSoalListId = [];
        foreach ($ujianSoalList as $row) {
            array_push($ujianSoalListId, $row->soal_id);
        }

        $soal = Soal::whereIn('id', $ujianSoalListId)->where('kategori', $request->kategori)->get();

        return response()->json([
            'message'   => 'Berhasil',
            'data'      => SoalResource::collection($soal)
        ]);
    }

    public function jawabSoalUjian(Request $request)
    {
        $validatedData = $request->validate([
            'soal_id' => 'required',
            'jawaban' => 'required',
        ]);

        $ujian = Ujian::where('user_id', $request->user()->id)->first();
        //--if $ujian empty, return empty:
        if(!$ujian){
            return response()->json([
                'message' => 'Failed : Ujian Not found',
                'data' => [],
            ]);
        }

        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->where('soal_id', $validatedData['soal_id'])->first();
        $soal = Soal::where('id', $validatedData['soal_id'])->first();


        if($soal->jawaban == $validatedData['jawaban']){
            $postedData['kebenaran'] = true;
            $ujianSoalList->update($postedData);
        }else{
            $postedData['kebenaran'] = false;
            $ujianSoalList->update($postedData);
        }
        
        // return response()->json($postedData);

        return response()->json([
            'message' => 'Berhasil : Jawaban tersimpan',
            'jawaban' => $postedData,
        ]);

    }
}
