<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechStackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
Route::apiResource('/categories', CategoryController::class);

Route::get('/article/{article:slug}', [ArticleController::class, 'show']);
Route::apiResource('/articles', ArticleController::class);

Route::get('/tech-stack/{tech-stack:id}', [TechStackController::class, 'show']);
Route::apiResource('/tech-stacks', TechStackController::class);

Route::get('/project/{project:slug}', [ProjectController::class, 'show']);
Route::apiResource('/projects', ProjectController::class);