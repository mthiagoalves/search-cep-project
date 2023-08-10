<?php

namespace App\Http\Controllers;

use App\Repositories\CepRepository;

class FrontendController extends Controller
{
    public function getAllCeps() {
        $allCeps = CepRepository::getAllCeps();

        dd($allCeps);
        
    }
}
