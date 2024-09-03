<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
use App\User;

class StaffPermissions{

    function handle($request, Closure $next ){

        if(Auth::check()){
            $user = Auth::user();
            if($user->isStaff()){
                return $next($request);
            }
        }
        $request->session()->flash('error', 'Invalid Login');
        return Redirect::route('login');

    }
}
