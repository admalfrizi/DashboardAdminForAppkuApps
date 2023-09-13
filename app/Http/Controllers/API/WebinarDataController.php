<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\Webinar;
use Validator;

class WebinarDataController extends Controller
{
    public function index(Request $request)
    {
        $webinar_id = $request->input("id");
        $webinar = Webinar::with('imageGalleries')->get();

        if($webinar_id){
            $idWebinarData = $webinar->find($webinar_id);
            return ResponseFormatter::success($idWebinarData,"Berikut Data untuk $idWebinarData->titleWebinar");
        }
     
        return ResponseFormatter::success($webinar,'Webinar Data List');

    }

    public function storeData(Request $request){
        $data = $request->validate([
            'titleWebinar' => 'required',
            'description' => 'required',
            'freeOrBuy' => 'required',
        ]);
    
        
        $webinar = Webinar::create($data);
 
        return ResponseFormatter::success($webinar,'Data Has Been Created');
    }

    public function updateData(Request $request, Webinar $kelas)
    {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'titleWebinar' => 'required',
            'description' => 'required',
            'freeOrBuy' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $webinar->titleWebinar = $input['titleWebinar'];
        $webinar->description = $input['description'];
        $webinar->freeOrBuy = $input['freeOrBuy'];
        $webinar->save();
    
        return ResponseFormatter::success($kelas,'Data Has Been Updated');
    }

    public function destroy(Webinar $kelas)
    {
        $kelas->delete();
    
        return ResponseFormatter::success($kelas,'Data Has Been Deleted');
    }
}
