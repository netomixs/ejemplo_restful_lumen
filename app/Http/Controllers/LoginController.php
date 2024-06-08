<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\GenericClass\ResponseObject;
use App\Models\CredentialModel;
use App\Models\TokenModel;

class LoginController extends BaseController
{
    /**
     * Login para obtener el token y acceso al sistema
     */
    public function login(Request $request)
    {
        $response = new   ResponseObject();
        $response->IsSuccess = false;
        try {
            $hash_contrasena = hash("sha256", $request->password);
            $data =  CredentialModel::where('user', $request->user)->where('password', $hash_contrasena)->first();

            if ($data) {
                $data->token = $this->tokenGenerator($data->user, $data->id_cred);
                $response->Data = $data;
                $response->IsSuccess = true;
                $response->Message = "Acceso correcto";
            } else {
                $response->Message = "Credenciales incorrectas";
            }
        } catch (Exception $e) {
            $response->Message = $e->getMessage();
        }

        return  response($response->toJson());
    }
    /**
     * Generacion del token
     * @param string $user usuario
     */
    private function tokenGenerator($user, $id)
    {
        $duration = 3600;
        $initial = date('Y-m-d H:i:s', time());
        $final = date('Y-m-d H:i:s',  time() + $duration);
        $randomString = $this->randomStringGeneration();
        $tokenObject = new TokenModel();
        $tokenObject->id_creds = $id;
        $tokenObject->created = $initial;
        $tokenObject->expired = $final;
        $payload = [
            'user' => $user,
            'iat' => $initial,
            'exp' => $final,
            'rnm' =>  $randomString
        ];
        $jwt = hash("sha1", json_encode($payload));
        $tokenObject->token = $jwt;
        if ($this->insertToken($tokenObject)) {
            return $jwt;
        } else {
            return null;
        }
    }
    /**
     * Insercion del token en la base de datos
     * @param TokenModel $token
     */
    private function insertToken(TokenModel $token)
    {
        return  $token->save();
    }
    /**
     * Generar string random 
     * @param int $minLength Minimo de longitud
     * @param int $name Maximo de longitud
     */
    private function randomStringGeneration($minLength = 200, $maxLength = 500)
    {
        $length = rand($minLength, $maxLength);
        $randomBytes = random_bytes($length);
        $randomString = bin2hex($randomBytes);
        return substr($randomString, 0, $length);
    }
}
