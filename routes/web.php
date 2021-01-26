<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishMigrationController;
use App\Http\Controllers\FishnewController;
use App\Http\Controllers\NewFishdbController;
use App\Http\Controllers\LkWorldDistController;
use App\Http\Controllers\FishOriginController;
use App\Http\Controllers\FishSpeciesWorldDistController;

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

Route::get('/fish', [FishMigrationController::class, 'index']);
Route::get('/fishnew', [FishnewController::class, 'index']);
Route::get('/newfishdb', [NewFishdbController::class, 'store']);
Route::get('/worlddist-init', [LkWorldDistController::class, 'init']);
Route::get('/origin', [FishOriginController::class, 'oldToNew']);
Route::get('/fish-worldist', [FishSpeciesWorldDistController::class, 'showDist']);
Route::get('/fish-hasmany', [FishOriginController::class, 'testHasManyAssocitate']);
Route::get('/fish-many2many', [FishOriginController::class, 'testManyToManyAssocitate']);
