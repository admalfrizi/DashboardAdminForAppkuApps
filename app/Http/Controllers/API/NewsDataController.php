<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\News;
use Validator;

class NewsDataController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');
        $berita = News::query()->with('imageGalleries');

        if($id){
            $oneBeritaData = $berita->find($id);
            return ResponseFormatter::success($oneBeritaData,"Berikut Data untuk $oneBeritaData->nameNews");
        }

        $beritaAll = $berita->get();
        
        return ResponseFormatter::success($beritaAll,'Data untuk Berita');
    }

    public function storeData(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'nameNews' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $berita = News::create($input);
 
        return ResponseFormatter::success($berita,'Data Has Been Created');
    }

    public function updateData(Request $request, News $berita)
    {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'nameNews' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $berita->nameNews = $input['nameNews'];
        $berita->save();
    
        return ResponseFormatter::success($berita,'Data Has Been Updated');
    }

    public function destroy(News $berita)
    {
        $berita->delete();
    
        return ResponseFormatter::success($berita,'Data Has Been Deleted');
    }
}
