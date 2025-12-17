<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class verifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập lại');
        }

        $user = Auth::user();

        if ($user->role !== 'admin' && $user->email_verified_at === NULL) {
            return back()
                ->with('notAuthentication', 'Xác thực tài khoản đi khách iu của em ơi!!!');
        }
        return $next($request);
    }
}
