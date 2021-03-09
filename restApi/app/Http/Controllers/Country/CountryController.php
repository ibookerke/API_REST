<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryModel;

class CountryController extends Controller
{
    public function country() {
        return response()->json(countryModel::get(), 200);
    }

    public function countryById($id){
        return response()->json(countryModel::find($id), 200);
    }

    public function countryAdd(Request $req) {
        $country = CountryModel::create($req->all());
        return response()->json($country, 201);
    }
}
