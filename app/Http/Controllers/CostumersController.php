<?php

namespace App\Http\Controllers;


use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\GenericClass\ResponseObject;
use App\Models\CommunesModel;
use App\Models\CostumersModel;
use App\Models\RegionsModel;

class CostumersController extends BaseController
{
    /**
     * Insertar a costumers
     * @param Request $request
     */
    public function insert(Request $request)
    {
        $response = new   ResponseObject();
        $response->IsSuccess = false;
        try {
            //Primero verifica si la resgion esta activa
            $region = RegionsModel::where("id_reg", $request->region)
                ->where("status", "A")
                ->first();

            if ($region) {
                //Verifica que la Commune exista en la region y este activa
                $commune = CommunesModel::where("id_com", $request->commune)
                    ->where("id_reg", $request->region)
                    ->where("status", "A")
                    ->first();
                if ($commune) {
                    //Registra los datos
                    $model = new CostumersModel();
                    $model->dni = $request->dni;
                    $model->id_reg = $request->region;
                    $model->id_com  = $request->commune;
                    $model->email  = $request->email;
                    $model->last_name = $request->lastName;
                    $model->name = $request->name;
                    $model->address = $request->address;
                    $model->date_reg =  date('Y-m-d H:i:s', time());
                    $model->status = $request->status;;
                    if ($model->save()) {
                        $response->IsSuccess = true;
                        $response->Message = "Registro exitoso";
                        $response->Data = $model;
                    } else {
                        $response->IsSuccess = false;
                        $response->Message = "Registro no exitoso";
                    }
                } else {
                    $response->IsSuccess = false;
                    $response->Message = "Commune no existe o no esta disponible en la region";
                }
            } else {
                $response->IsSuccess = false;
                $response->Message = "Region no disponible";
            }
        } catch (Exception $e) {
            $response->Message = $e->getMessage();
        }
        return response($response->toJson());
    }
    /**
     * Obtener por correo o Dni
     * @param Request $request
     */
    public function get(Request $request)
    {
        $response = new   ResponseObject();
        $response->IsSuccess = false;
        try {
            $data =  CostumersModel::with(["region", "commune"])->where("email", $request->email)->where("status", "A")->orWhere("dni", $request->dni)->where("status", "A")->first();
            if ($data) {
                if ($data->address == "") {
                    $data->address = null;
                }
                $response->Data = $data;

                $response->IsSuccess = true;
                $response->Message = "Datos obtenidos con exito";
            } else {
                $response->Data = $data;
                $response->IsSuccess = true;
                $response->Message = "Registro no existe";
            }
        } catch (Exception $e) {
            $response->Message = $e->getMessage();
        }
        return response($response->toJson());
    }
    /**
     * Eliminacion de costumer
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $response = new   ResponseObject();
        $response->IsSuccess = false;
        try {
            $data = CostumersModel::where("dni", $request->dni)->first();
 
            if ($data) {
                if ($data->status != "trash") {
                    $data->status = "trash";;
                    if ($data->save()) {
                        $response->IsSuccess = true;
                        $response->Message = "Registro eliminado";
                    } else {
                        $response->IsSuccess = false;
                        $response->Message = "Registro no eliminado";
                    }
                } else {
                    $response->Message = "Registro no existe";
                }
            }
        } catch (Exception $e) {
            $response->Message = $e->getMessage();
        }

        return response($response->toJson());
    }
}
