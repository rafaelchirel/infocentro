<?php

namespace Infocentro\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Admin
{
    protected $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(Auth $auth) {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->admin()) {
            return $next($request);
        } else {
            abort(401);
        }
    }
}
