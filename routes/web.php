<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishSpeciesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fish-hasmany-species-worlddist', [FishSpeciesController::class, 'testHasManySpeciesWorlddist']);
Route::get('/fish-n2m-worlddist', [FishSpeciesController::class, 'testManyToManyWorldDist']);
Route::get('/fish-ectype', [FishSpeciesController::class, 'testHasOneEctype']);
Route::get('/fish-depth', [FishSpeciesController::class, 'testDepth']);
Route::get('/fish-n2m-twdist', [FishSpeciesController::class, 'testManyToManyTwDist']);
Route::get('/fish-n2m-fishtype', [FishSpeciesController::class, 'testManyToManyFishType']);
Route::get('/fish-n2m-habitat', [FishSpeciesController::class, 'testManyToManyHabitat']);
Route::get('/fish-export-csv', [FishSpeciesController::class, 'exportCsv']);
