<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\News;
use Validator;

class NewsDataController extends Controller
{
    public function index()
    {
        $berita = News::with('imageGalleries')->get();
        
        return ResponseFormatter::success($berita,'News Data List');
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
