<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Localization;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then:function()
        {
            Route::middleware('api')
            ->prefix('user')
            ->group(base_path('routes/user.php'));
              Route::middleware('api')
            ->prefix('admin')
            ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(Localization::class);
        $middleware->api([Localization::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
