<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PersonalInfoController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider and assigned to
| the "api" middleware group. Build your API here!
|
*/


Route::apiResource('personal-info', PersonalInfoController::class);
Route::apiResource('skills', SkillController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('experiences', ExperienceController::class);
Route::apiResource('contacts', ContactController::class);


Route::post('/storage/uploads', [UploadController::class, 'store']);


Route::post('/send-message', [ContactController::class, 'sendMessage']);
