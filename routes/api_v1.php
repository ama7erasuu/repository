<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RequestsController;

Route::post('/requests',[RequestsController::class ,'NewRequestSave']);
Route::get('/requests',[RequestsController::class ,'RequestsAll']);
