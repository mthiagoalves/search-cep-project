<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CepRepository;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function getAllCeps()
    {
        $allCeps = CepRepository::getAllCeps();

        if (count($allCeps) === 0) {
            return response()->json(['message' => 'Nenhum CEP encontrado no banco de dados'], 404);
        } else {
            return response()->json($allCeps, 200);
        }
    }

    public function getOneCep($cep)
    {

        $cep = CepRepository::getOneCep($cep);

        return response()->json($cep, 200);
    }

    public function createAddress(Request $dataRequest)
    {

        $address = CepRepository::createAddress($dataRequest);

        return response()->json($address, 200);
    }

    public function updateAddress(Request $dataRequest, $cep)
    {

        $address = CepRepository::updateAddress($dataRequest, $cep);

        return response()->json($address);
    }

    public function deleteAddress($cep)
    {

        $response = CepRepository::deleteAddress($cep);

        if ($response['success']) {
            return response()->json(['message' => $response['message']], 200);
        } else {
            return response()->json(['message' => $response['message']], 400);
        }
    }
}
