<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function currentWeather()
    {
        $apiKey = env('WEATHER_API');
        $city = 'Hanoi';

        $client = new Client();
        $response = $client->request('GET', 'http://api.weatherapi.com/v1/current.json?', [
            'query' => [
                'key' => $apiKey,
                'q' => $city,
                'aqi' => 'yes',
            ]
        ]);
        $data = json_decode($response->getBody(), true);

        return response()->json(['data' => $data]);
    }
}
