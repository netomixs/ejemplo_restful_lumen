<?php

namespace App\Http\Middleware;

use App\GenericClass\ResponseObject;
use Closure;
use Response;

class CostumersInsertMiddleware
{
    /**
     * Validacion de deatos entes de insertar costumer
     */
    public function handle($request, Closure $next)
    {
        $response = new ResponseObject();
        $rules = [
            'dni' => 'required|string|max:45',
            'region' => 'required|int',
            'commune' => 'required|int',
            'email' => 'required|string|max:120|email',
            'name' => 'required|string|max:45',
            'lastName' => 'required|string|max:45',
            'address' => 'string|max:255',
            'status' => 'required|string|min:1|max:1',
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
