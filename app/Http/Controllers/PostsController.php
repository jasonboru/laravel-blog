<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Week;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = DB::select('SELECT * FROM posts');
        //return Post::where('title', 'Post Two')->get();

        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        $posts = Post::orderBy('created_at','desc')->paginate(6);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
          'crop_name' => 'required',
          'strain' => 'required',
          'body' => 'required',
          'cover_image' => 'image|nullable|max:1999'
        ]);

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
          //$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

          $file = $request->file('cover_image');
          $hashedName = $request->file('cover_image')->hashName();

          Storage::disk('s3')->put('uploads/' . $fileNameToStore, $file, 'public');

        } else {
          $fileNameToStore = 'noimage.jpg';
        }

        // Create Posts
        $post = new Post;
        $post->crop_name = $request->input('crop_name');
        $post->strain = $request->input('strain');
        $post->method = $request->input('method');
        $post->location = $request->input('location');
        $post->lighting = $request->input('lighting');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        if($request->hasFile('cover_image')){
          $post->cover_image = $fileNameToStore . '/' . $hashedName;
        } else {
          $post->cover_image = 'noimage.jpg';
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $weeks = Week::all()->where('post_id', '=', $id);
        return view('posts.show')->with('post', $post)->with('weeks', $weeks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user_id
        if(auth()->user()->id !== $post->user_id){
          return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post', $post);
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
          'crop_name' => 'required',
          'strain' => 'required'
        ]);

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
          //$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

          $file = $request->file('cover_image');
          $hashedName = $request->file('cover_image')->hashName();

          Storage::disk('s3')->put('uploads/' . $fileNameToStore, $file, 'public');

        }

        // Create Posts
        $post = Post::find($id);
        $post->crop_name = $request->input('crop_name');
        $post->strain = $request->input('strain');
        $post->body = $request->input('body');
        $post->method = $request->input('method');
        $post->location = $request->input('location');
        $post->lighting = $request->input('lighting');
        if($request->hasFile('cover_image')){
          $post->cover_image = $fileNameToStore . '/' . $hashedName;
        }
        $post->save();

        return redirect('/posts/' . (int) $id)->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check for correct user_id
        if(auth()->user()->id !== $post->user_id){
          return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image !== 'noimage.jpg'){
          // Delete the image
          Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');

    }
}
