<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role_id != 1){
            $request->session()->flash('danger','Acces non autorisé !!!');
            return redirect('/login');
        }

        $path = explode('/',$request->path());
	    if(in_array('dashboard',$path)){
		    Session::put('active', 1);
	    }
	    if(in_array('entreprises',$path)){
		    Session::put('active', 2);
	    }

        if(in_array('rapports',$path)){
		    Session::put('active', 3);
	    }

        if(in_array('indicateurs',$path)){
		    Session::put('active', 4);
	    }
	    if(in_array('articles',$path)){
		    Session::put('active', 5);
	    }
        if(in_array('user',$path)){
		    Session::put('active', 6);
	    }
	    if(in_array('communes',$path)||in_array('tags',$path)||in_array('categories',$path)||in_array('params',$path)){
		    Session::put('active', 7);
	    }


        return $next($request);
    }
}
