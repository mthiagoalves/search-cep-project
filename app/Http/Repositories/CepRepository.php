<?php

namespace App\Http\Repositories;

use App\Models\Address;

use Illuminate\Support\Facades\Validator;

class CepRepository
{

    private static function validateCep($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (strlen($cep) !== 8) {
            return ['message' => 'CEP inválido, insira um CEP de 8 números.'];
        }

        return null;
    }

    public static function getAllCeps()
    {
        return Address::all();
    }

    public static function getOneCep($cep)
    {
        $validationResult = self::validateCep($cep);
        if ($validationResult) {
            return $validationResult;
        }

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
        $validationResult = self::validateCep($cep);
        if ($validationResult) {
            return $validationResult;
        }

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

        $address = Address::where('cep', $cep)->first();

        if (!$address) {
            return ['success' => false, 'message' => 'Endereço não encontrado'];
        }

        $address->fill($dataAddress->validated());

        if ($address->save()) {
            return ['success' => true, 'message' => 'Endereço atualizado com sucesso'];
        } else {
            return ['success' => false, 'message' => 'Erro ao atualizar o endereço'];
        }
    }


    public static function deleteAddress($cep)
    {

        $validationResult = self::validateCep($cep);
        if ($validationResult) {
            return $validationResult;
        }

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
