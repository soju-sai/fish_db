<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fishnew;

class FishnewController extends Controller
{
    public function index()
    {
        //
        foreach (Fishnew::all() as $fishnew) {
            echo $fishnew->title . '<br>';
        }
    }
}
