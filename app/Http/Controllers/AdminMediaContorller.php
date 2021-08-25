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

        }
    }


    /**
     * Multiple select and delete media
     */
    public function mediaDelete(Request $request){

        //Single media delete
        if(isset($request->delete_single)){

            //call destroy method pass the photo id
            $this->destroy($request->photo_id);
            Session::flash('success', 'Photo has been deleted successfully ): ');
            return redirect()-> back();

        }


        // Multiple media delete
        if(isset($request->delete_all) && !empty($request->checkBoxArray)){

            $photos = Photo::findOrFail($request->checkBoxArray);

            foreach($photos as $photo){
                if(file_exists($photo->file)){
                    unlink($photo->file);
                }
                $photo->delete();
            }

            Session::flash('success', 'Media files has been deleted successfully :) ');
            return redirect()->back();

        }else {

            Session::flash('error', 'Please select any item, then delete it ! ');
            return redirect()->back();

        }

    }

}
