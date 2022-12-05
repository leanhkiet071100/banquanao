<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLogoController extends Controller
{
    public function logo(){
        return view('admin.static.logo');
    }

    public function logo_them(){

    }
}
