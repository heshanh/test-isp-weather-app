<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeatherAPI\WeatherAPIService;
use Illuminate\Http\Request;

class WeatherForecastController extends Controller
{
    public function index(Request $request, WeatherAPIService $weatherAPIService)
    {
        $city = $request->get('city');

        if(blank($city))
        {
            return;
        }

        try
        {
            $response = $weatherAPIService->getForecastByCity($city);

            return response($response->getForecastByDay());

        } catch (\Exception $clientException)
        {
            return response($clientException->getMessage(), $clientException->getCode());
        }

    }
}
