<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediaContorller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move(public_path('images/'), $name);
        Photo::create(['file' => $name]);

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
        $photo = Photo::findOrFail($id);
        if($photo){
            if(file_exists($photo->file) && !empty($photo->file)){
                unlink($photo->file);
            }

            $photo->delete();
            Session::flash('success', 'Photo has been deleted successfully ): ');
            return redirect()-> back();
        }
    }


    /**
     * Multiple select and delete media
     */
    public function mediaDelete(Request $request){

        $photos = Photo::findOrFail($request->checkBoxArray);

        foreach($photos as $photo){
            if(file_exists($photo->file)){
                unlink($photo->file);
            }
            $photo->delete();
        }

        Session::flash('success', 'Media file has been deleted successfully :) ');
        return redirect()->back();

    }

}
