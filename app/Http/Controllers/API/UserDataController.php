<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function fetch() {

        return ResponseFormatter::success($request->user(),"Data anda sebagai berikut");

    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator =  $request->validate([
            'name'     => 'required',
            'email'   => 'required',
        ]);

        //find post by ID
        $post = User::find($id);

        $post->update([
            'name'     => $request->name,
            'email'   => $request->email,
        ]);

        return ResponseFormatter::success([
            'user' => $post
        ], 'User Has Been Updated');
    }


}
