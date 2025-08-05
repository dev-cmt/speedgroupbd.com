<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemberMiddleware
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
        if (Auth::check()) {
            $status = Auth::user()->status;
        
            if ($status == 5) {
                return redirect()->route('member_renew.create'); // Go to renewal page
            } elseif ($status == 0 || $status == 6) {
                return redirect()->route('member-approve.pending'); // Go to approval page
            }
        }
        // If none of the above, continue as normal
        return $next($request);
    }
}
