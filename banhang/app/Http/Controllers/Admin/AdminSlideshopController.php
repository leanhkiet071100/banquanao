<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSlideshopController extends Controller
{
    public function slideshow(){
        return view('admin.hinhanh.slideshow');
    }
}
