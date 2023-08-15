<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CepRepository;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FrontendController extends Controller
{
    public function getAllCeps(): Response
    {
        $ceps = CepRepository::getAllCeps();

        return Inertia::render('Cep/Homepage', [
            'ceps' => $ceps
        ]);
    }

    public function getOneCep($cep)
    {

        $response = CepRepository::getOneCep($cep);

        return response()->json($response, 200);
    }

    public function createAddress(Request $dataRequest)
    {
        $response = CepRepository::createAddress($dataRequest);

        return $response;
    }

    public function updateAddress(Request $dataRequest, $cep)
    {

        $response = CepRepository::updateAddress($dataRequest, $cep);

        return $response;
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
