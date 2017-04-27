<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ParsedownExtra;

class SubmissionController extends Controller
{
    public function save(Request $request)
    {
        print_r($request->all());
        $extra = new ParsedownExtra();
        echo $extra->text($request->question17);

    }
}