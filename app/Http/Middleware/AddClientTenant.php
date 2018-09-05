<?php

namespace CodeFin\Http\Middleware;

use Closure;

class AddClientTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $requestIntegração do multi-tenancy
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('api/*')){
            $user = \Auth::guard('api')->user();
            if ($user){
                $client = $user->client;
                \Landlord::addTenant($client);
            }
        }

        return $next($request);
    }
}
