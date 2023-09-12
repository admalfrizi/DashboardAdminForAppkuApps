<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelasCategory;

class KelasCategoryController extends Controller
{
    public function index() {
        $kelasCategory = KelasCategory::all();

        return view('pages.navscreen.kelas.kategori.index', compact('kelasCategory'));
    }

    public function create() {

        return view('pages.navscreen.kelas.kategori.create_kelasCategory');
    }


    public function store(Request $request) {
        $data = $request->all();

        KelasCategory::create($data);

        return redirect()->route('dashboard.categoryKelas.index');
    }

    public function edit($id) {

        $categoryKelas = KelasCategory::find($id);

        return view('pages.navscreen.kelas.kategori.edit_kelasCategory', compact('categoryKelas'));
    }

    public function update($id) {

        KelasCategory::findOrFail($id)->update([
            'categoryName' => $request->categoryName,
        ]);

        return redirect()->route('dashboard.categoryKelas.index');
    }

    public function delete($id) {
        KelasCategory::findOrFail($id)->delete();
        
        return redirect()->route('dashboard.categoryKelas.index');
    }
}
