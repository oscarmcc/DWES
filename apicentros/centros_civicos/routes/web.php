<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentroCivicoController;

Route::resource('centros', CentroCivicoController::class);
