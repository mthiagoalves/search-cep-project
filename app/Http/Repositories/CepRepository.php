<?php

namespace App\Http\Repositories;

use App\Models\Address;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class CepRepository
{

    private static function validateCep($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (strlen($cep) !== 8) {
            return response()->json(['message' => Config::get('custom-messages.field_must_8_characters')], 400);
        }

        return null;
    }

    public static function getAllCeps()
    {
        $response = Address::all();

        if (count($response) === 0) {
            return ['message' => Config::get('custom-messages.not_found_address')];
        } else {
            return $response;
        }
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

        try {
            $response = file_get_contents($apiUrl);

            if ($response) {
                $data = json_decode($response);

                if (isset($data->erro) && $data->erro === true) {
                    return ['message' => Config::get('custom-messages.address_not_found')];
                } else {
                    return $data;
                }
            } else {
                return ['message' => Config::get('custom-messages.address_not_found')];
            }
        } catch (\ErrorException $e) {
            return ['message' => 'Erro ao buscar o CEP: ' . $cep];
        }
    }

    return $findedCep;
}



    public static function createAddress($dataRequest)
    {
        $data = $dataRequest->all();

        $existingAddress = Address::where('cep', $data['cep'])->first();

        if ($existingAddress) {
            return response()->json(['message' => Config::get('custom-messages.address_exist_in_db')], 400);
        }

        $dataAddress = Validator::make($data, [
            "cep" => "required|string|size:8",
            "public_place" => "required|string",
            "complement" => "nullable",
            "burgh" => 'required|string',
            "locality" => "required|string",
            "state_acronym" => "required|string"
        ]);

        if ($dataAddress->fails()) {
            $errors = $dataAddress->errors();
            return response()->json(['message' => Config::get('custom-messages.field_must_8_characters'), 'error' => $errors->all()], 400);
        }

        $newAddress = Address::create($data);

        return $newAddress;
    }

    public static function updateAddress($dataRequest, $cep)
    {
        $data = $dataRequest->all();

        $dataAddress = Validator::make($data, [
            "cep" => "required|string|size:8",
            "public_place" => "required|string",
            "complement" => "nullable",
            "burgh" => 'required|string',
            "locality" => "required|string",
            "state_acronym" => "required|string"
        ]);

        if ($dataAddress->fails()) {
            $errors = $dataAddress->errors();
            return response()->json(['message' => Config::get('custom-messages.field_must_8_characters'), 'error' => $errors->all()], 400);
        }

        $existingAddress = Address::where('cep', $data['cep'])->whereNotIn('cep', [$cep])->first();

        if ($existingAddress) {
            return response()->json(['message' => Config::get('custom-messages.address_exist_in_db')], 400);
        }

        $address = Address::where('cep', $cep)->first();

        if (!$address) {
            return response()->json(['message' => Config::get('custom-messages.address_not_found')], 400);
        }

        $address->fill($dataAddress->validated());

        $address->save();
        if ($address->save()) {
            return ['success' => true, 'message' => Config::get('custom-messages.address_updated_success')];
        } else {
            return ['success' => false, 'message' => Config::get('custom-messages.address_updated_error')];
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
            return ['success' => false, 'message' => Config::get('custom-messages.address_not_found')];
        }

        if ($address->delete()) {
            return ['success' => true, 'message' => Config::get('custom-messages.address_deleted_success')];
        } else {
            return ['success' => false, 'message' => Config::get('custom-messages.address_deleted_error')];
        }
    }
}
