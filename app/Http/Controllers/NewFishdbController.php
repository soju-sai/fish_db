<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewFishdb;

class NewFishdbController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the request...

        $newfish = new NewFishdb;

        $newfish->name = 'test';

        $newfish->save();
    }
}
