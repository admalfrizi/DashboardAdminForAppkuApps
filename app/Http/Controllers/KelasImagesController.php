<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelasImages;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

class KelasImagesController extends Controller
{
    public function index($id) {
        $kelas = Kelas::find($id);
        $imgRef = KelasImages::where('kelas_id', $kelas->id)->get();

        return view('pages.navscreen.kelas.kelasImages.index', [
            'kelas' => $kelas,
            'imageRef' => $imgRef
        ]);
    }

    public function create($id) {
        $kelas = Kelas::find($id);
        return view('pages.navscreen.kelas.kelasImages.create_kelasImages', compact('kelas'));
    }

    public function store(Request $request, $id) {
        $files = $request->file('files');
        $kelas = Kelas::find($id);

        if($request->hasFile('files')){
            foreach ($files as $file) {
                $destination_path = "public/images/kelasImages/$kelas->id";
                $fileName = $file->getClientOriginalName();
                $file->storeAs($destination_path,$fileName);

                KelasImages::create([
                    'kelas_id' => $kelas->id,
                    'image' => $fileName
                ]);
            }
        }

        return redirect()->route('dashboard.kelas.kelasGallery.index', $kelas->id);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $kelasId = $request->kelasId;
        $kelas = Kelas::find($kelasId);

        $kelasImage = KelasImages::findOrFail($id);
        $imagePath = storage_path().'/app/public/images/kelasImages/'.$kelas->id.'/'.$kelasImage->image;
        unlink($imagePath);
        $kelasImage->delete();

        return redirect()->route('dashboard.kelas.kelasGallery.index', $kelas->id);
    }
}
