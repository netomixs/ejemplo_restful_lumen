<?php

namespace App\Http\Middleware;

use App\GenericClass\ResponseObject;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Storage;

class LogMiddleware
{
    /**
     * Validacion de campos para generar el token
     */
    public function handle(Request $request, Closure $next)
    {

     try {
        $appStatus=env('APP_DEBUG',false);
        if($appStatus){
            
                $data = json_encode($request->all());
                $msj = "[Entrada] ip: {$request->ip()} - Peticion: {$request->method()} - Datos: { $data}";
                $this->log($msj);
                return $next($request);
          
        }else{
            $data = json_encode($request->all());
            $msj = "[Entrada] ip: {$request->ip()} - Peticion: {$request->method()} - Datos: { $data}";
            $this->log($msj);
            $response= $next($request);
            $data = json_encode($response);
            $msj = "[Salida]  ip: {$request->ip()} - Peticion: {$request->method()} - Datos: { $data}";
            $this->log($msj);

            return $response;
        }
     } catch (Exception $e) {
      echo $e->getMessage();
     }
      
 
     
    }
    function log($msj)
    {
        $logFile =   '..\storage\logs\events.log';
        if (!file_exists($logFile)) {
            $logDir = dirname($logFile);
            if (!is_dir($logDir)) {
                mkdir($logDir, 0777, true);
            }
            $file = fopen($logFile, 'w');
            if ($file) {
                fclose($file);
                $this->logMessage($msj, $logFile);
            } else {
                exit;
            }
        } else {

            $this->logMessage($msj, $logFile);
        }
    }
    function logMessage($message, $logFile)
    {
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[$timestamp] $message" . PHP_EOL;
        file_put_contents($logFile, $formattedMessage, FILE_APPEND);
    }
}
