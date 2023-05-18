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
	    if(in_array('ventes',$path)){
		    Session::put('active', 2);
	    }

        if(in_array('fournisseurs',$path)){
		    Session::put('active', 21);
	    }

        if(in_array('clients',$path)){
		    Session::put('active', 3);
	    }
	    if(in_array('articles',$path)){
		    Session::put('active', 4);
	    }
        if(in_array('fidelite',$path)){
		    Session::put('active', 5);
	    }
	    if(in_array('litiges',$path)){
		    Session::put('active', 6);
	    }
        if(in_array('rapports',$path)){
		    Session::put('active', 7);
	    }
	    if(in_array('compte',$path)){
		    Session::put('active', 8);
	    }

        if(in_array('applications',$path)){
		    Session::put('active', 9);
	    }
	    if(in_array('factures',$path)){
		    Session::put('active', 10);
	    }
        if(in_array('terminal',$path)){
		    Session::put('active', 11);
	    }
	    if(in_array('employes',$path)){
		    Session::put('active', 12);
	    }
        if(in_array('comptabilite',$path)){
		    Session::put('active', 13);
	    }
	    if(in_array('boutique',$path)){
		    Session::put('active', 11);
	    }

        return $next($request);
    }
}
