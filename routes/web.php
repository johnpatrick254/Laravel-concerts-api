<?php
namespace App\http\Controllers;

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::apiResource('events',EventsController::class);
Route::apiResource('events.attendee',AttendeeController::class)->scoped(['attendee'=>'event']);