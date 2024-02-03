<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\RetrieveUser;

class ExternalAuth
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
        //does request has token ? 
        if(!$request->hasHeader('authorization')){
            return response()->json(['errors' => "unauthorized" ,'message'=>'no token found for authorization'], 401);
        }

        //is this token valid ?
        $userService = new RetrieveUser();
        $user = $userService->getUserData($request->header('authorization'));

        if($user && $user['user_id']){
            $request['user_data'] = $user['user_id'];
        }

        return $next($request);
    }
}
