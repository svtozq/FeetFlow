<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;


class SurveyController extends Controller
{
    public function chart(Request $request): View
    {
        $right = $request->input('input1');
        $wrong = $request->input('input2');

        session(['right' => $right, 'wrong' => $wrong]);
        return view('results');
    }
}
