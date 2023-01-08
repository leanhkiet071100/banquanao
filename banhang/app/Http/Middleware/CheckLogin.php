<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        // echo 'middle';
        //chưa đăng nhập
        if(!Auth::check()){
            return redirect()->route('login-admin')->with('yes','Bạn vui lòng đăng nhập để thực hiện chức năng');
        }elseif(Auth::user()->cap == 1 ){
            return $next($request);
        }elseif(Auth::user()->cap == 2 ){
            return redirect()->route('index')->with('yes','bạn không có quyền hạn vào trang admin');
        }
        return $next($request);
    }
}
