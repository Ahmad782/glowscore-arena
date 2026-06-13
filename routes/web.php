<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
Route::get('/',[StudentController::class,'index']);
Route::get('/students/create',[StudentController::class,'create']);
Route::post('/students',[StudentController::class,'store']);
Route::get('/students/{student}',[StudentController::class,'show']);
Route::post('/students/{student}/attendance',[StudentController::class,'addAttendance']);
Route::post('/students/{student}/marks',[StudentController::class,'addMark']);
Route::post('/students/{student}/points',[StudentController::class,'addPoint']);
Route::delete('/students/{student}',[StudentController::class,'destroy']);
