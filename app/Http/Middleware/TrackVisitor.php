<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor; // Import model
use Illuminate\Support\Facades\Auth; // Import Auth

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        Visitor::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'user_id'    => Auth::id()
        ]);

        return $next($request);
    }
}
