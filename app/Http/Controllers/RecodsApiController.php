<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config;

class RecodsApiController extends Controller
{
    public function getRecordsApi(ServerRequestInterface $request) {

        if (!Gate::allows('getRecordsApi-RecordsApi')) {
            abort(403);
        }

        $config = new Config([
            'address' => env('DB_HOST', '127.0.0.1'),
            'username' => env("DB_USERNAME"),
            'password' => env("DB_PASSWORD"),
            'database' => env("DB_DATABASE"),
            'basePath' => '/api',
        ]);
        $api = new Api($config);
        $response = $api->handle($request);
        return $response;

    }
}
