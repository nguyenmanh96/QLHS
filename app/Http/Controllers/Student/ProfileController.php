<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Repositories\Repository\StudentRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $student = Auth::user()->student;
        return view('student.profile', compact('student'));
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

    public function update(ImageRequest $request)
    {
        if ($image = $request->file('upload')) {
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->storeAs('avatar', $imageName, 'public');
            Auth::user()->update(['avatar' => $imageName]);

            return redirect('student/profile')->with('success', __('messages.upload_ok'));
        }
        return redirect('student/profile')->with('success', __('messages.upload_error'));
    }
}
