<?php

namespace Infocentro\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Habilitado
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
        if ($this->auth->user()->habilitado()) {
            return $next($request);
        } else {
            return response(view('errors.inhabilitado'));
        }
    }
}
