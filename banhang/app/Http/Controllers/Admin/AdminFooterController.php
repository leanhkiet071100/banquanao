<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFooterController extends Controller
{
    //footer
    function footer(){
        return view('admin.trangtinh.footer.footer');
    }

    function footer_them(){
        
    }
}
