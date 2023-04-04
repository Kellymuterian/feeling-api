<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ToDoController;
use App\Http\Controllers\Api\MemberController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('member', [MemberController::class, 'index']);
Route::post('member', [MemberController::class, 'store']);
Route::get('member/{id}', [MemberController::class, 'show']);
Route::get('member/{id}/edit', [MemberController::class, 'edit']);
Route::put('member/{id}/edit', [MemberController::class, 'update']);
Route::delete('member/{id}/delete', [MemberController::class, 'destroy']);

Route::get('todo', [ToDoController::class, 'papi']);
Route::post('todo', [ToDoController::class, 'store']);
Route::get('todo/{id}', [ToDoController::class, 'show']);
Route::get('todo/{id}/edit', [ToDoController::class, 'edit']);
Route::put('todo/{id}/edit', [ToDoController::class, 'update']);
Route::delete('todo/{id}/delete', [ToDoController::class, 'destroy']);
