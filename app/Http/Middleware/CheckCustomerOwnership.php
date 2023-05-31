<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCustomerOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $customer = $request->user();
        $id = $request->route('id');

        // Check if user owns the requested resource
        if ($customer->id !== (int) $id) {
            return response()->json([
                'message' => 'You do not have permission to access this resource.'
            ], 403);
        }

        return $next($request);
    }
}
