<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin page load
     */
    public function index(){
        return view('admin.index');
    }
}
