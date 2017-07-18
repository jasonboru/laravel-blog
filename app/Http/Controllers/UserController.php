<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;

class UserController extends Controller
{
    public function profile() {
      return view('pages.profile', array('user' => Auth::user()));
    }

    public function update_avatar(Request $request) {
      if($request->hasFile('avatar')){
        // Get filename with the extension
        $filenameWithExt = $request->file('avatar')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('avatar')->getClientOriginalExtension();
        // Filename to Store
        $fileNameToStore = $filename. '_' .time().'.'.$extension;
        // Upload image
        //$path = $request->file('avatar')->storeAs('public/cover_images', $fileNameToStore);

        $file = $request->file('avatar');
        $hashedName = $request->file('avatar')->hashName();

        Storage::disk('s3')->put('uploads/' . $fileNameToStore, $file, 'public');

      } else {
        $fileNameToStore = 'noimage.jpg';
      }

      $user = Auth::user();
      $user->avatar = $fileNameToStore . '/' . $hashedName;
      $user->save();

      return view('pages.profile', array('user' => Auth::user()) );
    }


}
