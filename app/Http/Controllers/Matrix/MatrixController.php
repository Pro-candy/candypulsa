<?php

namespace App\Http\Controllers\Matrix;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
    public function index()
    {
        return view('matrix.index');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'birthdate' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        $birthdate = $request->birthdate;
        $gender = $request->gender;
        $result = $this->calculateMatrix($birthdate);

        $readings = $this->generateReadings($result);

        return view('matrix.result', compact('birthdate', 'gender', 'result', 'readings'));
    }


    private function calculateMatrix($birthdate)
    {
        // Placeholder algoritma sederhana
        $sum = array_sum(str_split(str_replace('-', '', $birthdate)));
        $lifePath = $sum % 22 ?: 22;

        return [
            'Life Path Number' => $lifePath,
            'Soul Code' => ($lifePath * 2) % 22 ?: 22,
            'Karmic Number' => ($lifePath + 7) % 22 ?: 22,
        ];
    }

    private function generateReadings($result)
    {
        $jsonPath = resource_path('data/matrix_readings.json');
        $readingsData = json_decode(file_get_contents($jsonPath), true);

        $readings = [];

        foreach ($result as $key => $value) {
            $readings[$key] = $readingsData[$key][$value] ?? 'Makna belum tersedia untuk angka ini.';
        }

        return $readings;
    }


}
