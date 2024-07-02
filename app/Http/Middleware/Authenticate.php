<?php

namespace App\Http\Middleware;

use App\Models\PersonalAccessTokens;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Authenticate
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
        $token = $request->bearerToken();
        
        $user_token= PersonalAccessTokens::where(['token'=> $token  ] )
                                                ->orderBy('created_at','desc')
                                                ->first();

        /* 
        select * from PersonalAccessTokens where email = 'email' and token = '******' */
        
        if (!$user_token) {
            return response()->json(['message' => 'Acceso denegado'], 401);
        }

        return $next($request);
    }
}