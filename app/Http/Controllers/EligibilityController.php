<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneralTrait;
use Illuminate\Http\Response;

class EligibilityController extends Controller
{
    //
    use GeneralTrait;


    /**
     * @OA\Get(
     *    path="/eligibility",
     *    tags={"Eligibility"},
     *    summary="Get Status of Eligibility",

     *     @OA\Response(
     *     response="200", 
     *     description="An example endpoint"
     *   ),
     *  @OA\Parameter(
     *      name="adress_code",
     *      in="path",
     *      required=true,
     *      description= "adress code",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="city_code",
     *      in="path",
     *      required=true,
     *      description= "city code",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="HTTP INTERNAL SERVER ERROR"
     *      )
     * )
     */
    public function index(Request $request)
    {
        try {

            ini_set('memory_limit', '512M');
            $adress_code = $request->input('adress_code');
            $city_code = $request->input('city_code');
            $filePath = 'public/json/departments/' . substr($city_code, 0, 2) . '.json';
            $file = Storage::get($filePath);
            $jsonData = json_decode($file);

            $response = [
                "orange" => in_array($adress_code, $jsonData->orange),
                "bouygues" => in_array($adress_code, $jsonData->bouygues),
                "free" => in_array($adress_code, $jsonData->free),
                "sfr" => in_array($adress_code, $jsonData->sfr),
                "version" => "10/03/2023"
            ];

            return $this->returnData($response, Response::HTTP_OK);
        } catch (\Exception $e) {
            return  $this->returnError(424, $e->getMessage());
        }
    }
}
