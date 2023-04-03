<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EligibilityController extends Controller
{
    //
    public function index(Request $request)
    {
        ini_set('memory_limit', '512M');
        $adress_code = $request->input('adress_code');
        $city_code = $request->input('city_code');
        $filePath = 'public/json/departments/' . substr($city_code, 0, 2) . '.json';
        $file = Storage::get($filePath);
        $jsonData = json_decode($file );
        $response = [
            "orange" => in_array($adress_code, $jsonData->orange),
            "bouygues" => in_array($adress_code, $jsonData->bouygues),
            "free" => in_array($adress_code, $jsonData->free),
            "sfr" => in_array($adress_code, $jsonData->sfr),
            "version" => "10/03/2023"
        ];
        return $response;
    }
}