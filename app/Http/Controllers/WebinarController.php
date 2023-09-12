<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webinar;


class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::all();

        return view('pages.navscreen.webinar.index', compact('webinars'));
    }

    public function create() {

        return view('pages.navscreen.webinar.create_webinar');
    }

    
    public function store(Request $request) {
        $data = $request->all();

        Webinar::create($data);

        return redirect()->route('dashboard.webinar.index');
    }

    public function edit($id) {
        $webinar = Webinar::findorFail($id);

        return view('pages.navscreen.webinar.edit_webinar', compact("webinar"));
    }

    public function update(Request $request,$id) {
        
        Webinar::findOrFail($id)->update([
            'titleWebinar' => $request->titleWebinar,
            'description' => $request->description,
            'freeOrBuy' => $request->freeOrBuy,
        ]);

        return redirect()->route('dashboard.webinar.index');
    }

    public function delete($id) {
        Webinar::findOrFail($id)->delete();

        return redirect()->route('dashboard.webinar.index');
    }
}
