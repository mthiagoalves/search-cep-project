<?php

namespace App\Http\Repositories;

use App\Models\Address;

use Illuminate\Support\Facades\Validator;

class CepRepository
{
    public static function getAllCeps()
    {
        return Address::all();
    }

    public static function getOneCep($cep)
    {
        $findedCep = Address::where('cep', $cep)->get();

        if ($findedCep->isEmpty()) {
            $apiUrl = 'https://viacep.com.br/ws/' . $cep . '/json/';
            $response = file_get_contents($apiUrl);

            if ($response) {
                $data = json_decode($response);

                if (isset($data->erro) && $data->erro === true) {
                    return ['message' => 'CEP não encontrado'];
                } else {
                    return $data;
                }
            } else {
                return ['message' => 'CEP não encontrado'];
            }
        }

        return $findedCep;
    }

    public static function createAddress($dataRequest)
    {

        $data = $dataRequest->all();

        $dataAddress = Validator::make($data, [
            "cep" => "required|integer",
            "public_place" => "required|string",
            "complement" => "nullable",
            "burgh" => 'required|string',
            "locality" => "required|string",
            "state_acronym" => "required|string"
        ]);

        if ($dataAddress->fails()) {
            $errors = $dataAddress->errors();

            return ['errors' => $errors->all()];
        }

        $newAddress = Address::create($dataAddress->validated());

        return $newAddress;
    }

    public static function updateAddress($dataRequest, $cep)
    {
        $data = $dataRequest->all();

        $dataAddress = Validator::make($data, [
            "cep" => "required|integer",
            "public_place" => "required|string",
            "complement" => "nullable",
            "burgh" => 'required|string',
            "locality" => "required|string",
            "state_acronym" => "required|string"
        ]);

        if ($dataAddress->fails()) {
            $errors = $dataAddress->errors();
            return ['success' => false, 'message' => 'Erro de validação', 'errors' => $errors->all()];
        }

        $updatedRows = Address::where('cep', $cep)->update($dataAddress->validated());

        if ($updatedRows > 0) {
            return ['success' => true, 'message' => 'Endereço atualizado com sucesso'];
        } else {
            return ['success' => false, 'message' => 'Nenhum endereço foi atualizado'];
        }
    }

    public static function deleteAddress($cep) {
        
        $address = Address::where('cep', $cep)->first();

        if (!$address) {
            return ['success' => false, 'message' => 'Endereço não encontrado'];
        }

        if ($address->delete()) {
            return ['success' => true, 'message' => 'Endereço excluído com sucesso'];
        } else {
            return ['success' => false, 'message' => 'Erro ao excluir o endereço'];
        }
    }

}
