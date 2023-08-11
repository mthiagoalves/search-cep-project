<?php

namespace App\Http\Repositories;

use App\Models\Address;

use Illuminate\Support\Facades\Validator;

class CepRepository
{
    public static function getAllCeps() {
        return Address::all();
    }

    public static function getOneCep($cep) {
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

    public static function createAddress($dataRequest){

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


}
