<?php

namespace App\Http\Middleware;

use App\GenericClass\ResponseObject;
use Closure;
use Response;
use Illuminate\Http\Request;

class CostumersDeleteByDniMiddleware
{
    /**
     * Validacion que los parametros sea o email o dni
     */
    public function handle(Request $request, Closure $next)
    {
        $response = new ResponseObject();

        $response = new ResponseObject();
        $rules = [
            'dni' => 'required|string|max:45',
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
