<?php

use App\Http\Controllers\API\EventoController;
use App\Http\Controllers\API\MarcadorController;
use App\Http\Controllers\API\MapaController;
use App\Http\Controllers\RecodsApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return response()->json([
        'token_type' => 'Bearer',
        'access_token' => $user->createToken('token_name')->plainTextToken // token name you can choose for your self or leave blank if you like to
    ]);
});

//Route::middleware('auth:sanctum')->

Route::group(['middleware' => 'auth:sanctum'],function () {
    Route::group(['prefix' => '/'], function () {

        Route::apiResource("/eventos", EventoController::class);
        Route::apiResource("/marcadores", MarcadorController::class);
        Route::apiResource("/mapas", MapaController::class);

    });
});

//Añadir middleware y controlar solo admin entra
Route::middleware('auth:sanctum')->any('/{any}', [RecodsApiController::class, "getRecordsApi"])->where('any', '.*');
