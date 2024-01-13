<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsInvitedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            $meeting = $request->route('meeting');
            $is_invited = $meeting->attendances->contains(function ($attendance) { // データが存在するかチェック

                return (intval($attendance->user_id) === intval(auth()->id()));
            });

            if ($is_invited === true) {

                return $next($request);
            }
        }

        return redirect('/'); // 強制リダイレクト
    }
}
