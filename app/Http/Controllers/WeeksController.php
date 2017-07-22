<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Week;
use App\Post;
use DB;

class WeeksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('weeks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('weeks.create')->withPost($request->post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $id)
    {
      $this->validate($request, [
        'week_num' => 'required',
        'nutrient' => 'required',
        'dosage' => 'required',
        'temperature' => 'required',
        'humidity' => 'required',
        'week_image'=> 'image|nullable|max:1999',

      ]);

      //Handle File upload
      if($request->hasFile('week_image')){
        // Get filename with the extension
        $filenameWithExt = $request->file('week_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('week_image')->getClientOriginalExtension();
        // Filename to Store
        $fileNameToStore = $filename. '_' .time().'.'.$extension;
        // Upload image
        //$path = $request->file('week_image')->storeAs('public/week_images', $fileNameToStore);

        $file = $request->file('week_image');
        $hashedName = $request->file('week_image')->hashName();

        Storage::disk('s3')->put('uploads/' . $fileNameToStore, $file, 'public');

      } else {
        $fileNameToStore = 'noimage.jpg';
      }


      // Create Posts
      $week = new Week;
      $week->week_num = $request->input('week_num');
      $week->nutrient = $request->input('nutrient');
      $week->dosage = $request->input('dosage');
      $week->additives = $request->input('additives');
      $week->tds = $request->input('tds');
      $week->ph = $request->input('ph');
      $week->temperature = $request->input('temperature');
      $week->humidity = $request->input('humidity');
      $week->notes = $request->input('notes');
      if($request->hasFile('week_image')){
        $week->week_image = $fileNameToStore . '/' . $hashedName;
      } else {
        $week->week_image = 'noimage.jpg';
      }
      $week->post_id = $request->input('post_id');
      $week->save();

      //return redirect('/posts')->with('success', 'Week Created');
      return redirect()->action("WeeksController@show", $week->id)->with('success', 'Week Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $week = Week::find($id);
      $uid = $week->post->user_id;

      return view('weeks.show')->with('week', $week);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      $week = Week::find($id);

      return view('weeks.edit')->with('week', $week)->withPost($request->post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'week_num' => 'required',

      ]);

      //Handle File upload
      if($request->hasFile('week_image')){
        // Get filename with the extension
        $filenameWithExt = $request->file('week_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('week_image')->getClientOriginalExtension();
        // Filename to Store
        $fileNameToStore = $filename. '_' .time().'.'.$extension;
        // Upload image
        //$path = $request->file('week_image')->storeAs('public/week_images', $fileNameToStore);

        $file = $request->file('week_image');
        $hashedName = $request->file('week_image')->hashName();

        Storage::disk('s3')->put('uploads/' . $fileNameToStore, $file, 'public');

      } else {
        $fileNameToStore = 'noimage.jpg';
      }

      // Create Posts
      $week = Week::find($id);
      $week->week_num = $request->input('week_num');
      $week->nutrient = $request->input('nutrient');
      $week->dosage = $request->input('dosage');
      $week->additives = $request->input('additives');
      $week->tds = $request->input('tds');
      $week->ph = $request->input('ph');
      $week->temperature = $request->input('temperature');
      $week->humidity = $request->input('humidity');
      $week->notes = $request->input('notes');
      if($request->hasFile('week_image')){
        $week->week_image = $fileNameToStore . '/' . $hashedName;
      } else {
        $week->week_image = 'noimage.jpg';
      }

      $week->save();

      //return redirect('/weeks')->with('success', 'Week Updated');
      return redirect()->action("WeeksController@show", $week->id)->with('success', 'Week Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $week = Week::find($id);

      if($week->week_image !== 'noimage.jpg'){

        // Delete the image
        Storage::delete('public/week_images/'.$week->week_image);
      }

      $week->delete();
      return redirect('/posts')->with('success', 'Week Removed');
    }
}
