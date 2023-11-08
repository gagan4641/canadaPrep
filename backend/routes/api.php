<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\QualificationController;
use App\Http\Controllers\Api\GenerateChecklistController;
use App\Http\Controllers\Api\MaritalStatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('countries', [CountryController::class, 'list']);
Route::get('categories', [CategoryController::class, 'list']);
Route::get('qualifications', [QualificationController::class, 'list']);
Route::get('maritalStatuses', [MaritalStatusController::class, 'list']);
Route::post('generateChecklist', [GenerateChecklistController::class, 'create']);

Route::group(['middleware' => 'api'], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});