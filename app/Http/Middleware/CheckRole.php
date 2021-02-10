<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{


    public function handle(Request $request, Closure $next, string $role)
    {

        $roles = [
            'admin' => '1',
            //'user' => '2',
        ];

        $roleIds = $roles[$role] ?? '';
        
        if(Auth::id()){
            
            if(auth()->user()->role_id != $roleIds){
                abort(403);
            }

        }else{
            abort(403);
        }
        return $next($request);
    }
}
