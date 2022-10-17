<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('new_request','App\Http\Controllers\RequestsController@NewRequestSave');
