<?php 

use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
// cette ligne nous crée les routes suivantes
// GET          api/events          index
// GET          api/events/{event}  show
// POST         api/events          store
// PUT          api/events/{event}  update
// DELETE       api/events/{event}  destroy