<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        if($request->path()=='/login'){
            return $next($request);
        }
        if (!Auth::check()){
            return response()->json([
                'msg' => 'You are not allowed to access this route... ' ,
                'url' => $request->path()
            ], 403);
        }
        $user = Auth::user();
        if ($user->role->isAdmin == false){
            return response()->json([
                'msg' => 'You are not allowed to access this route... ',
            ], 403);
        }
        return $next($request);
    }
}
