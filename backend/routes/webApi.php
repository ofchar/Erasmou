<?php

use App\Http\Controllers\Web\ApartmentController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\FacultyController;
use App\Http\Controllers\Web\ForumController;
use App\Http\Controllers\Web\LandlordController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\ProvinceController;
use App\Http\Controllers\Web\RateableController;
use App\Http\Controllers\Web\RateController;
use App\Http\Controllers\Web\UniversityController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
// header('Access-Control-Allow-Origin: *');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('countries', CountryController::class)->except('index', 'show');

    Route::apiResource('cities', CityController::class)->except('index', 'show');

    Route::apiResource('provinces', ProvinceController::class)->except('index', 'show');

    Route::apiResource('universities', UniversityController::class)->except('index', 'show');

    Route::apiResource('faculties', FacultyController::class)->except('index', 'show');

    Route::apiResource('forums', ForumController::class)->except('index', 'show');

    Route::apiResource('posts', PostController::class)->except('index', 'show');

    Route::apiResource('apartments', ApartmentController::class)->except('index', 'show');

    Route::apiResource('landlords', LandlordController::class)->except('index', 'show');

    Route::apiResource('rates', RateController::class)->except('index', 'show');
});

Route::apiResource('countries', CountryController::class)->only('index', 'show');

Route::apiResource('cities', CityController::class)->only('index', 'show');

Route::apiResource('provinces', ProvinceController::class)->only('index', 'show');

Route::apiResource('universities', UniversityController::class)->only('index', 'show');

Route::apiResource('faculties', FacultyController::class)->only('index', 'show');

Route::apiResource('forums', ForumController::class)->only('index', 'show');

Route::apiResource('posts', PostController::class)->only('index', 'show');

Route::apiResource('apartments', ApartmentController::class)->only('index', 'show');

Route::apiResource('landlords', LandlordController::class)->only('index', 'show');

Route::apiResource('rateables', RateableController::class)->only('index', 'show');
