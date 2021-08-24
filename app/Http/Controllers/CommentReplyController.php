<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function createReplay(Request $request){

        CommentReply::create([
            'comment_id'    => $request->comment_id,
            'is_active'     => Auth::user()->is_active,
            'author'        => Auth::user()->name,
            'photo'         => Auth::user()->photo->file,
            'email'         => Auth::user()->email,
            'body'          => $request->body,
        ]);

        Session::flash('success', "Your reply has been submitted and is waiting modaretion");
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $replies = CommentReply::whereCommentId($id)->get();

        $comment = Comment::findOrFail($id);
        $replies = $comment->commentReplies;

        return view('admin.comments.replies.show', compact('replies'));

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
        $reply = CommentReply::findOrFail($id);
        $reply->update($request->all());

        $request->session()->flash('success', 'Reply has been updated successfull :) ');
        return redirect()->back();
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
