<?php

use App\Http\Controllers\Web\ApartmentController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\FacultyController;
use App\Http\Controllers\Web\ForumController;
use App\Http\Controllers\Web\ProvinceController;
use App\Http\Controllers\Web\UniversityController;
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

header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');



Route::apiResource('countries', CountryController::class);

Route::apiResource('cities', CityController::class);

Route::apiResource('provinces', ProvinceController::class);

Route::apiResource('universities', UniversityController::class);

Route::apiResource('faculties', FacultyController::class);

Route::apiResource('forums', ForumController::class);

Route::apiResource('apartments', ApartmentController::class);