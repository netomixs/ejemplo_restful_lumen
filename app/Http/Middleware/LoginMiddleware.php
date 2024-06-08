<?php

namespace App\Http\Middleware;

use App\GenericClass\ResponseObject;
use Closure;
use Exception;
use Response;

class LoginMiddleware
{
    /**
     * Validacion de campos para generar el token
     */
    public function handle($request, Closure $next)
    {
        $response = new ResponseObject();
        $rules = [
            'user' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
        $validator = Validator($request->all(), $rules);
        if (!$validator->fails()) {
            return $next($request);
        } else {
            $response->IsSuccess = false;
            $response->Message = $validator->errors();
            return response($response->toJson());
        }
    }
}
