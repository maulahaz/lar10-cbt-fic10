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

        //--Get Timer by Category:
        if($request->kategori == 'Area-1'){
            $timer = $ujian->timer_area1;
        }else if($request->kategori == 'Area-2'){
            $timer = $ujian->timer_area2;
        }else if($request->kategori == 'Area-3'){
            $timer = $ujian->timer_area3;
        }else if($request->kategori == 'Area-9'){
            $timer = $ujian->timer_area9;
        }

        return response()->json([
            'message'   => 'Berhasil',
            'timer'     => $timer,
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

    public function getExamResultByKategori(Request $request)
    {
        $category = $request->category;
        $ujian = Ujian::where('user_id', $request->user()->id)->first();
        if (!$ujian) {
            return response()->json([
                'message' => 'Failed : Ujian Not found',
                'data' => [],
            ]);
        }
        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->get();
        //--ujiansoallist by kategori
        $ujianSoalList = $ujianSoalList->filter(function ($value, $key) use ($category) {
            return $value->soal->kategori == $category;
        });

        //--Count Result
        $totalCorrect = $ujianSoalList->where('kebenaran', true)->count();
        $totalSoal = $ujianSoalList->count();
        if($totalSoal < 1){
            return response()->json([
                'message' => 'Fail : Total Question not available',
            ]);
        }

        // return response()->json($totalSoal);
        $result = ($totalCorrect / $totalSoal) * 100;

        //--Get Timer by Category:
        if($category == 'Area-1'){
            $category_field = 'nilai_area1';
            $status_field = 'status_area1';
            $timer_field = 'timer_area1';
        }else if($category == 'Area-2'){
            $category_field = 'nilai_area2';
            $status_field = 'status_area2';
            $timer_field = 'timer_area2';
        }else if($category == 'Area-3'){
            $category_field = 'nilai_area3';
            $status_field = 'status_area3';
            $timer_field = 'timer_area3';
        }else if($category == 'Area-9'){
            $category_field = 'nilai_area9';
            $status_field = 'status_area9';
            $timer_field = 'timer_area9';
        }

        $ujian->update([
            $category_field => $result,
            $status_field => 'done',
            $timer_field => 0,
        ]);

        return response()->json([
            'message' => 'Berhasil : Exam result updated',
            'Result' => $result,
        ]);
    }
}
