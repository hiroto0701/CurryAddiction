<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RegenerateSessionMiddleware
{
   /**
    * セキュリティ対策のためにセッションIDを定期的に再生成する
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
    public function handle($request, Closure $next)
    {
        // 最後のセッション再生成から1週間経過しているかチェック
        if (!session('last_regenerated') ||
            now()->diffInDays(session('last_regenerated')) >= 7) {

            session()->regenerate();

            // 再生成時間を記録
            session(['last_regenerated' => now()]);
        }

        return $next($request);
    }
}
