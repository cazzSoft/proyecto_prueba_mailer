<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class ValidarRol
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
       if(isset(auth()->user()->tipo_user)){
            if(auth()->user()->tipo_user=='US'){
                 return redirect('gestion/mail');
            }
            if(auth()->user()->tipo_user=='AD'){
                 return $next($request);
            }  
       }else{
         return redirect('/login');
       }
    }
}
