<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\LoginRequest;
class LoginAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            $user=Auth::user();
            //xét quyền
            if($user->access==1)
            {
                return $next($request);
            }
            else
            {
                return redirect('login');
            }

        }
        else
        {
            return redirect('login');

        }
    }
}
