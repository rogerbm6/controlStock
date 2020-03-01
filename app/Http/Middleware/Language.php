<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\App;

class Language
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
         //$request->server('HTTP_ACCEPT_LANGUAGE'); devuelve un string con el idioma del usuario
         //cortamos el string para dejar los primeros 2 caracteres es o en
         $leng = substr($handle = $request->server('HTTP_ACCEPT_LANGUAGE') , 0, 2);
         App::setLocale($leng);
         return $next($request);
     }
}
