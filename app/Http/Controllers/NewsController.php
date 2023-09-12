<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index() {
        $newsData = News::all();

        return view('pages.navscreen.berita.index', compact('newsData'));
    }

    public function toCreate() {

        return view('pages.navscreen.berita.create_news');
    }

    
    public function store(Request $request) {
        $data = $request->all();

        News::create($data);

        return redirect()->route('dashboard.news.index');
    }

    public function edit($id) {
        $news = News::findOrFail($id);

        return view('pages.navscreen.berita.edit_news', compact('news'));
    }

    public function update(Request $request, $id) {

        News::findOrFail($id)->update([
            'nameNews' => $request->nameNews,
            'descNews' => $request->descNews,
        ]);
        return redirect()->route('dashboard.news.index');
    }

    public function delete($id) {
        News::findOrFail($id)->delete();

        return redirect()->route('dashboard.news.index');
    }
}
