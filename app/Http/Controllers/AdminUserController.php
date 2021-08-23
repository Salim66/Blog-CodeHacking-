<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(trim($request->passwrod) == ''){
            $input = $request->except('password');
        }else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images/', $name);

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;

        }

        $input['password'] = bcrypt($request->password);

        User::create($input);

        return redirect()->route('users.index');
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
        $user   = User::findOrFail($id);
        $roles  = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        // return $request->all();

        // get user
        $user = User::findOrFail($id);

        // check password set or not
        if(trim($request->passwrod) == ''){
            $input = $request->except('password'); // ignore password
        }else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        // check photo
        $name = '';
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images/', $name);

            // old photo check
            if($user->photo != null){
                //find the  user photo
                $photo = Photo::findOrFail($user->photo->id);
                // check photo has or not
                if($photo){

                    //unlink old photo
                    if(file_exists($user->photo->file) && !empty($user->photo->file)){
                        unlink($user->photo->file);
                    }

                    $photo->update(['file' => $name]); // update photo
                    $input['photo_id'] = $photo->id;   // put the new photo_id

                }

            }else {
                $photo = Photo::create(['file' => $name]);
                $input['photo_id'] = $photo->id;   // put the new photo_id
            }

        }else {
            if($user->photo != null){
                $photo = Photo::findOrFail($user->photo->id);
                $input['photo_id'] = $photo->id;
            }
        }


        $user->update($input);

        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user){
            if($user->photo){
                if(file_exists($user->photo->file) && !empty($user->photo->file)){
                    unlink($user->photo->file);
                }
                $user->delete();
                return redirect()->route('users.index');
            }else {
                $user->delete();
                return redirect()->route('users.index');
            }

        }
    }
}
