<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user(); // Lấy thông tin user khi đã đăng nhập
        // Kiểm tra quyền của người dùng
        $route = $request->route()->getName();
        // dd($user->can($route));
        if($user->cant($route)){
            return redirect()->route('admin.error.show',['code'=>403]);
        }
        return $next($request);
    }
}
