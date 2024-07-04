<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // نحدد هنا أن الشخص إذا سجل دخول سيتوجه إلى الهوم او الآدمن و لن يستطيع التوجه إلى صفحة تسجيل الدخول
            // حددنا هذا هنا و في الراوت سرفس بروفايدر
            if (Auth::guard($guard)->check()) {
                if($guard == 'admin')
                    return redirect(RouteServiceProvider::ADMIN);
                else
                    return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}