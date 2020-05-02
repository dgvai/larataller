<?php 
namespace DGvai\Larataller\Middleware;

use Closure;
use Redirect;

class CanInstallMiddleware 
{
    public function handle($request, Closure $next)
    {
        if(config('larataller.installed')) 
        {
            abort(404);
        }
        return $next($request);
    }
}

