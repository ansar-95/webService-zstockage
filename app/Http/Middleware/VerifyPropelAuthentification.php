<?php

namespace App\Http\Middleware;

use Closure;

class VerifyPropelAuthentification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        $utilisateur = $request->session()->get('user');
        if ($utilisateur == null) {
            return response()->json(["Statut" => "non connnecté"]);
        }

        return $next($request);
    }

}
