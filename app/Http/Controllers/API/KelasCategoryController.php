<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\KelasCategory;
use Validator;

class KelasCategoryController extends Controller
{
    public function index()
    {
        $kelasCategory = KelasCategory::all();
     
        return ResponseFormatter::success($kelasCategory,'Kelas Category List');
    }

    public function storeData(Request $request){
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'categoryName' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $kelasCategory = KelasCategory::create($input);
 
        return ResponseFormatter::success($kelasCategory,'Data Has Been Created');
    }

    public function updateData(Request $request, KelasCategory $kelasCategory)
    {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'categoryName' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $kelasCategory->categoryName = $input['categoryName'];
        $kelasCategory->save();
    
        return ResponseFormatter::success($kelasCategory,'Data Has Been Updated');
    }

    public function destroy(KelasCategory $kelasCategory)
    {
        $kelas->delete();
    
        return ResponseFormatter::success($kelasCategory,'Data Has Been Deleted');
    }
}
