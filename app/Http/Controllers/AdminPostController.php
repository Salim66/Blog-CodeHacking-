<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Comment;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        // return $request->all();

        $input = $request->all();
        // $input['user_id'] = Auth::id();
        $user = Auth::user();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('images/'), $name);

            $photo = Photo::create(['file' => $name]);
            if($photo){
                $input['photo_id'] = $photo->id;
            }

        }

        // Post::create($input);
        $user->posts()->create($input);


        Session::flash('success', 'Post added has been successfully ): ');
        return redirect()->route('posts.index');


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
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
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
        $post = Post::findOrfail($id);
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('images/'), $name);

            // old photo check
            if($post->photo != null){
                // find the user photo
                $photo = Photo::findOrFail($post->photo->id);
                // check photo has or not
                if($photo){

                    if(file_exists($post->photo->file) && !empty($post->photo->file)){
                        unlink($post->photo->file);
                    }

                    $photo->update(['file' => $name]); // update photo
                    $input['photo_id'] = $photo->id; // put the new photo

                }
            }else {
                $photo = Photo::create(['file' => $name]);
                $input['photo_id'] = $photo->id;
            }
        }else {
            if($post->photo != null){
                $input['photo_id'] = $post->photo->id;
            }
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);

        Session::flash('success', 'Post has been updated successfully ):');
        return redirect()->route('posts.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->photo != null){
            if(file_exists($post->photo->file) && !empty($post->photo->file)){
                unlink($post->photo->file);
            }
        }
        $post->delete();

        Session::flash('success', 'Post has been deleted successfully ): ');
        return redirect()->route('posts.index');
    }


    // post
    public function post($slug){

        $post = Post::whereSlug($slug)->first();
        $comments = Comment::wherePostId($post->id)->get();
        return view('post', compact('post', 'comments'));

    }

}
