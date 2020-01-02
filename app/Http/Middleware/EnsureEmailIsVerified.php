<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 1.如果用户已登录
        // 2.并且未认证Email
        // 3.并且访问的不是email验证相关的URL或者退出的URL
        if ($request->user() &&
         !$request->user()->hasVerifiedEmail() &&
         !$request->is('email/*', 'logout')) {
            // 根据客户端返回对应的内容
            return $request->expectsJson()
                ? abort(403, '你的邮箱地址还没有验证.')
                : redirect()->route('verification.notice');
         }
        return $next($request);
    }
}
