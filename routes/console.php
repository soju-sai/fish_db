<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\InitWorldDist;
use App\Console\Commands\MapSpeciesWorldDist;
use App\Console\Commands\ReorganizeFishSpecies;
use App\Console\Commands\MapMany2ManyRelation;
use App\Console\Commands\HandleMediaData;

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

Artisan::command('fishdb:init-fishid', function () {
    $reorganizeFishSpecies = new ReorganizeFishSpecies;
    $reorganizeFishSpecies->handleFish1to1data();
})->describe('initial the record in fish_species table.');

Artisan::command('fishdb:init-worlddist', function () {
    $initWorldDist = new InitWorldDist;
    $initWorldDist->handle();
})->describe('initial the record in world_dist table.');

Artisan::command('fishdb:map-species-worlddist', function () {
    $mapSpeciesWorldDist = new MapSpeciesWorldDist;
    $mapSpeciesWorldDist->handle();
})->describe('Map relationship between species and worlddist, and insert data to species-worlddists table');

Artisan::command('fishdb:reorganize-species-ectype', function () {
    $reorganizeFishSpecies = new ReorganizeFishSpecies;
    $reorganizeFishSpecies->handleEctype();
})->describe('Reorganize ectype column in fish_species table');

Artisan::command('fishdb:reorganize-species-depth', function () {
    $reorganizeFishSpecies = new ReorganizeFishSpecies;
    $reorganizeFishSpecies->handleDepth();
})->describe('Import depth data into fish_species table');

Artisan::command('fish:map-many2many-species-twdist', function () {
    $mapMany2ManyRelation = new MapMany2ManyRelation;
    $mapMany2ManyRelation->handleFishSpeciesTwDist();
})->describe('Map relationship between species and twdist');

Artisan::command('fish:map-many2many-species-fishtype', function () {
    $mapMany2ManyRelation = new MapMany2ManyRelation;
    $mapMany2ManyRelation->handleFishSpeciesFishType();
})->describe('Map relationship between species and fish_type');

Artisan::command('fish:map-many2many-species-habitat', function () {
    $mapMany2ManyRelation = new MapMany2ManyRelation;
    $mapMany2ManyRelation->handleFishSpeciesHabitat();
})->describe('Map relationship between species and habitat');

Artisan::command('fish:init-media', function () {
    $initMedia = new HandleMediaData;
    $initMedia->handleMedia();
})->describe('Init export data from origin media data to new media data');

Artisan::command('fish:init-media-type', function () {
    $initMedia = new HandleMediaData;
    $initMedia->handleMediaType();
})->describe('Init data from origin media_type to new media_type');
