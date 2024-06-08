<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\GenericClass\ResponseObject;
use App\Models\TokenModel;
use DateTime;
use Illuminate\Http\Request;

class Authenticate
{

    /**
     * Verifica que se esta usando un token en Bearer y este exista en la base de datos y sea valido y vigente
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = new ResponseObject();


        try {
            //Compruba que se integre el Bearer token en el encabezado antes de hacer cualquier cosa
            $autorization = $request->header('Authorization');
            if (strpos($autorization, 'Bearer ') === 0) {
                $bearerToken = substr($autorization, 7);
                $tokenObject =   TokenModel::where("token", $bearerToken)->first();

                if ($tokenObject == null) {
                    $response->IsSuccess = false;
                    $response->Message = "Token inexistente";
                    $response->Data = $tokenObject;
                    return response($response->toJson());
                } else {

                    $currentDate = new DateTime(date('Y-m-d H:i:s', time()));
                    $dateExpired = new DateTime($tokenObject->expired);

                    if ($currentDate > $dateExpired) {
                        $response->IsSuccess = false;
                        $response->Message = "Token expirado";
                        return response($response->toJson());
                    }
                }
            } else {
                $response->IsSuccess = false;
                $response->Message = "No Bearer token";
                return response($response->toJson());
            }
            return $next($request);
        } catch (Exception $e) {
            $response->IsSuccess = false;
            $response->Message = $e->getMessage();
            return response($response->toJson());
        }
    }
}
