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

      ]);

      /* code to add image later

      //Handle File upload
      if($request->hasFile('cover_image')){
        // Get filename with the extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to Store
        $fileNameToStore = $filename. '_' .time().'.'.$extension;
        // Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
      } else {
        $fileNameToStore = 'noimage.jpg';
      }

      */

      // Create Posts
      $week = new Week;
      $week->week_num = $request->input('week_num');
      $week->nutrient = $request->input('nutrient');
      $week->dosage = $request->input('dosage');
      $week->temperature = $request->input('temperature');
      $week->humidity = $request->input('humidity');
      $week->notes = $request->input('notes');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
