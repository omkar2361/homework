<?php

namespace App\Http\Middleware;

use Closure;
use HipsterJazzbo\Landlord\Facades\Landlord;

class Tenant
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
        if ($request->hasHeader('Tenant')) {

            $tenantId = $request->header('Tenant');

            Landlord::addTenant('tenant_id', $tenantId);
        }

        return $next($request);
    }
}
