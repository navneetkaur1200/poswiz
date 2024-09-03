<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyCheck
{
    public function handle(Request $request, Closure $next)
    {
        
        $passKey = 'AmahN2az9mbxkTOz43NmhTNzUzN2kDZwBDNiVDN5386';
        $headers = apache_request_headers();  
        if(isset($headers['Pass-Key']) && $headers['Pass-Key'] != "" ){
            if($passKey == $headers['Pass-Key']){
                return $next($request);
            }else{
                return response()->json(['error' => 'Invalid Pass Key.'], 401);
            }
        } else{
            return response()->json(['error' => 'Missing Pass Key.'], 401);
        } 
    }
}
