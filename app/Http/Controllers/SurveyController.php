<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SurveyController extends Controller
{
    public function chart($input1, $input2): View
    {
        return view('results.chart', compact('input1', 'input2'));
    }
}
