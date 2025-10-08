<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = $request->user();
        if(!$user || !$user->can($permission)) {
            abort(403, "You don't have permission.");
        }
        return $next($request);
    }
}
