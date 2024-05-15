<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function adminDashboard()
    {

        if (Auth::user()->type !== 'Admin') {
            return redirect()->back();
        }

        return view('admin.dashboard');
    }

    public function currentTime()
    {
        $client = new Client();

        try {
            $response = $client->get('http://worldtimeapi.org/api/ip');

            $data = json_decode($response->getBody(), true);

            $time = $data['datetime'];

            return response()->json(['time' => $time]);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function currentWeather()
    {
        $apiKey = '7f76453f8ac745bb982164522241205';
        $city = '21.028511, 105.804817';

        $client = new Client();
        $response = $client->request('GET', 'http://api.weatherapi.com/v1/current.json?key=7f76453f8ac745bb982164522241205&q=21.028511,%20105.804817&aqi=yes&lang=vi', [
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
