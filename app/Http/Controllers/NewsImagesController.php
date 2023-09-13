<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsImages;
use App\Models\News;

class NewsImagesController extends Controller
{
    public function index($id) {
        $news = News::find($id);
        $imgRef = NewsImages::where('news_id', $news->id)->get();

        return view('pages.navscreen.berita.newsImages.index', [
            'newsItem' => $news,
            'imageRef' => $imgRef
        ]);
    }

    public function create($id) {
        $news = News::find($id);

        return view('pages.navscreen.berita.newsImages.create_newsImages', compact('news'));
    }

    public function store(Request $request, $id) {
        $files = $request->file('files');
        $news = News::find($id);

        if($request->hasFile('files')){
            foreach ($files as $file) {
                $destination_path = "public/images/newsImages/$news->id";
                $fileName = time().'.'.$file->extension();
                $file->storeAs($destination_path,$fileName);

                NewsImages::create([
                    'news_id' => $news->id,
                    'image' => $fileName
                ]);
            }
        }

        return redirect()->route('dashboard.news.newsGallery.index', $news->id);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $newsId = $request->newsId;
        $news = News::find($newsId);

        $newsImage = NewsImages::findOrFail($id);
        $imagePath = storage_path().'/app/public/images/newsImages/'.$news->id.'/'.$newsImage->image;
        unlink($imagePath);
        $newsImage->delete();
        

        return redirect()->route('dashboard.news.newsGallery.index', $news->id);
    }
}
