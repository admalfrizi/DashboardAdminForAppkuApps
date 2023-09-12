<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelasCategory;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index() {
        $queryKelas = Kelas::all();

        return view('pages.navscreen.kelas.kelasData.index',compact('queryKelas'));
    }

    public function create(){
        $kelasKategory = KelasCategory::all();

        return view('pages.navscreen.kelas.kelasData.create_kelas', compact('kelasKategory'));
    }

    public function store(Request $request) {
        $data = $request->all();

        Kelas::create($data);

        return redirect()->route('dashboard.kelas.index');
    }

    public function edit($id) {
        $dataKelasCategory = KelasCategory::all();
        $kelas = Kelas::findorFail($id);

        return view('pages.navscreen.kelas.kelasData.edit_kelasData', [
            'itemKelas' => $kelas,
            'categories' => $dataKelasCategory
        ]);
    }

    public function update(Request $request) {

        $kelas_id = $request->id;

        Kelas::findOrFail($kelas_id)->update([
            'category_id'    => KelasCategory::find($request->category_id)->id,
            'titleKelas'     => $request->titleKelas,
            'stage'   => $request->stage,
            'jmlhVideo' => $request->jmlhVideo
        ]);

        return redirect()->route('dashboard.kelas.index');
    }

    public function delete($id) {

        Kelas::findOrFail($id)->delete();

        return redirect()->route('dashboard.kelas.index');
    }

}
