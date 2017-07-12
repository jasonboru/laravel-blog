<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Week;
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
    public function create()
    {
        return view('weeks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $path = $request->file('week_image')->storeAs('public/week_images', $fileNameToStore);
      } else {
        $fileNameToStore = 'noimage.jpg';
      }


      // Create Posts
      $week = new Week;
      $week->week_num = $request->input('week_num');
      $week->nutrient = $request->input('nutrient');
      $week->dosage = $request->input('dosage');
      $week->temperature = $request->input('temperature');
      $week->humidity = $request->input('humidity');
      $week->notes = $request->input('notes');
      $week->week_image = $fileNameToStore;
      $week->post_id = 0;//where do i get the post id????
      $week->save();

      return redirect('/posts')->with('success', 'Week Created');
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
      return view('weeks.show')->with('week', $week);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $week = Week::find($id);

      // Check for correct user_id
      //if(auth()->user()->id !== $post->user_id){
        //return redirect('/posts')->with('error', 'Unauthorized Page');
      //}

      return view('weeks.edit')->with('week', $week);
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
        $path = $request->file('week_image')->storeAs('public/week_images', $fileNameToStore);
      } else {
        $fileNameToStore = 'noimage.jpg';
      }

      // Create Posts
      $week = Week::find($id);
      $week->week_num = $request->input('week_num');
      $week->nutrient = $request->input('nutrient');
      $week->dosage = $request->input('dosage');
      $week->temperature = $request->input('temperature');
      $week->humidity = $request->input('humidity');
      $week->notes = $request->input('notes');
      if($request->hasFile('week_image')){
        $week->week_image = $fileNameToStore;
      }
      $week->post_id = 0;//where do i get the post id????
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

      // Check for correct user_id
      //if(auth()->user()->id !== $post->user_id){
        //return redirect('/posts')->with('error', 'Unauthorized Page');
      //}

      if($week->week_image !== 'noimage.jpg'){
        // Delete the image
        Storage::delete('public/week_images/'.$week->week_image);
      }

      $week->delete();
      return redirect('/posts')->with('success', 'Week Removed');
    }
}
