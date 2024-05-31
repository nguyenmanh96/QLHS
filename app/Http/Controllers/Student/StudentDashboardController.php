<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Repositories\Repository\StudentRepository;
use App\Repositories\Repository\UserRepository;
use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    protected $studentRepository;
    protected $userRepository;

    public function __construct(StudentRepository $studentRepository,UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $loggedInUser = Auth::user();
        $student = $loggedInUser->student;
        return view('student.dashboard', compact('student'));
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
            $image->move(public_path('avatar'), $imageName);
            $id = Auth::user()->id;
            $this->userRepository->update($id, ['avatar' => $imageName]);

            return redirect('student/profile')->with('success', 'ok');
        }
        return redirect('student/profile')->with('success', 'k duoc');
    }
}
