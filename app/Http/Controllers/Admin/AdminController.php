<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\IndexRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }
}
