<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FishMigrationController extends Controller
{
    //
    public function index()
    {
        $fishes = DB::select('select * from fishnews');

        foreach ($fishes as $fish) {
            echo $fish->title.'<br>';
        }
    }
}
