<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\InitWorldDist;
use App\Console\Commands\MapSpeciesWorldDist;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('fishdb:init-worlddist', function () {
    $initWorldDist = new InitWorldDist;
    $initWorldDist->handle();
})->describe('initial the record in world_dist table.');

Artisan::command('fishdb:map-species-worlddist', function () {
    $mapSpeciesWorldDist = new MapSpeciesWorldDist;
    $mapSpeciesWorldDist->handle();
})->describe('Map relationship between species and worlddist, and insert data to species-worlddists table');
