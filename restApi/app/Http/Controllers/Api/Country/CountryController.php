<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\CountryModel;
use Illuminate\Support\Facades\Validator;


class CountryController extends Controller{

    public function country() {
        //auth check
        try{
            $user = auth()->userOrFail();
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
        //returning all data
        return response()->json(countryModel::get(), 200);
    }

    public function countryById($id){
        //auth check
        try{
            $user = auth()->userOrFail();
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        //check if id exists
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(['error'=> true, 'message' => 'Not found'], 404);
        }

        return response()->json( $country, 200);
    }

    public function countryByPage($page){
        //auth check
        try{
            $user = auth()->userOrFail();
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        //check if id exists
//        $country = CountryModel::find($id);
//        if(is_null($country)){
//            return response()->json(['error'=> true, 'message' => 'Not found'], 404);
//        }
        return response()->json(countryModel::skip(($page - 1) * 19)->limit(19)->get(), 200);
    }

    public function countryAdd(Request $req) {
        //auth check
        try{
            $user = auth()->userOrFail();
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
        //prompt validation
        $rules = [
            'alias' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3',
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $country = CountryModel::create($req->all());
        return response()->json($country, 201);
    }

    public function countryEdit(Request $req, $id) {
        //auth check
        try{
            $user = auth()->userOrFail();
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        //prompt validation
        $rules = [
            'alias' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3',
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //check if id exists
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(['error'=> true, 'message' => 'Not found'], 404);
        }

        $country->update($req->all());
        return response()->json($country, 200);
    }

    public function countryDelete($id) {
        //auth check
        try{
            $user = auth()->userOrFail();
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }

        //check if id exists
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(['error'=> true, 'message' => 'Not found'], 404);
        }

        $country->delete();
        return response()->json('', 200);
    }

}

