<?php

namespace App\Http\Middleware;

use App\GenericClass\ResponseObject;
use Closure;
use Response;
use Illuminate\Http\Request;

class CostumersGetByEmailOrDniMiddleware
{
    /**
     * Validacion que los parametros sea o email o dni
     */
    public function handle(Request $request, Closure $next)
    {
        $response = new ResponseObject();

        if (!$request->hasAny(["email", "dni"])) {
            $response->IsSuccess = false;
            $response->Message = "Debe proporcionar al menos un correo electrónico o un DNI";
            return response($response->toJson());
        }
        return $next($request);
    }
}
