<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebinarImages;
use App\Models\Webinar;
use Illuminate\Support\Facades\Storage;

class WebinarImagesController extends Controller
{
    public function index($id) {
        $webinar = Webinar::find($id);
        $imgRef = WebinarImages::where('webinar_id', $webinar->id)->get();

        return view('pages.navscreen.webinar.webinarImagesGallery.index', [
            'webinarItem' => $webinar,
            'imageRef' => $imgRef
        ]);
    }

    public function create($id) {
        $webinar = Webinar::find($id);

        return view('pages.navscreen.webinar.webinarImagesGallery.create_webinarImages', compact('webinar'));
    }

    public function store(Request $request, $id) {
        $files = $request->file('files');
        $webinar = Webinar::find($id);

        if($request->hasFile('files')){
            foreach ($files as $file) {
                $destination_path = "public/images/webinarImages/$webinar->id";
                $fileName = $file->getClientOriginalName();
                $file->storeAs($destination_path,$fileName);

                WebinarImages::create([
                    'webinar_id' => $webinar->id,
                    'image' => $fileName
                ]);
            }
        }

        return redirect()->route('dashboard.webinar.webinarGallery.index', $webinar->id);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $webinarId = $request->webinarId;
        $webinar = Webinar::find($webinarId);

        $webinarImage = WebinarImages::findOrFail($id);
        $imagePath = storage_path().'/app/public/images/webinarImages/'.$webinar->id.'/'.$webinarImage->image;
        unlink($imagePath);
        $webinarImage->delete();
        

        return redirect()->route('dashboard.webinar.webinarGallery.index', $webinar->id);
    }
   
}
