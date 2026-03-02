<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculation;

class CalculationController extends Controller
{
    public function calculate(Request $request)
    {
        $first = $request->first_number;
        $operator = $request->operator;
        $second = $request->second_number;

        $result = 0;

        switch ($operator) {
            case '+':
                $result = $first + $second;
                break;
            case '-':
                $result = $first - $second;
                break;
            case '*':
                $result = $first * $second;
                break;
            case '/':
                $result = $second != 0 ? $first / $second : 0;
                break;
        }

        // Save to database
        Calculation::create([
            'first_number' => $first,
            'operator' => $operator,
            'second_number' => $second,
            'result' => $result
        ]);

        return response()->json([
            'result' => $result
        ]);
    }
}