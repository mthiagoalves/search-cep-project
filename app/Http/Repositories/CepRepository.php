<?php

namespace App\Repositories;

use App\Models\Address;

class CepRepository
{
    public static function getAllCeps() {
        return Address::all();
    }
}
