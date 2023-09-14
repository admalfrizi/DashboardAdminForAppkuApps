<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\KelasCategory;
use Validator;

class KelasDataController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');
        $categories = $request->input('categories');
        $kelas = Kelas::query()->with(['categoryKelas', 'imageGalleries']);

        if($categories){
            $categoryData = $kelas->whereHas('categoryKelas', function ($query) use($kelas, $categories){
                $query->where('category_id', $categories);
            })->get();

            $categoriName =  KelasCategory::find($categories)->categoryName;

            return ResponseFormatter::success($categoryData,"Berikut Data Kelas Dengan Kategori $categoriName");
        }

        if($id){
            $oneKelasData = $kelas->find($id);
            return ResponseFormatter::success($oneKelasData,"Berikut Data untuk $oneKelasData->titleKelas");
        }

        $kelasAll = $kelas->get();
    
        return ResponseFormatter::success($kelasAll,"Data Kelas Berikut");
    }

    public function storeData(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'titleKelas' => 'required',
            'stage' => 'required',
            'jmlhVideo' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $kelas = Kelas::create($input);
 
        return ResponseFormatter::success($kelas,'Data Has Been Created');
    }

    public function updateData(Request $request, Kelas $kelas)
    {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'titleKelas' => 'required',
            'stage' => 'required',
            'jmlhVideo' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $kelas->titleKelas = $input['titleKelas'];
        $kelas->stage = $input['stage'];
        $kelas->jmlhVideo = $input['jmlhVideo'];
        $kelas->save();
    
        return ResponseFormatter::success($kelas,'Data Has Been Updated');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
    
        return ResponseFormatter::success($kelas,'Data Has Been Deleted');
    }
}
