<?php

namespace cardial\Http\Middleware;

use Closure;

class Autorizador {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (!$request->is('login') && \Auth::guest() && !$request->is('webservice/login') && !$request->is('webservice/lista-visita')) {
            return redirect('/login');
        }
        return $next($request);
    }

}
