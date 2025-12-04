<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',

        using: function (Router $router) {
            $router->middleware('web')
                ->group(__DIR__.'/../routes/web.php');



            // grouping admin routes
            $router->middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(function () use ($router) {
                    $adminRoutesPath = __DIR__.'/../routes/admin';

                    foreach (glob($adminRoutesPath.'/*.php') as $file) {
                        $router->group([], $file);
                    }
                });
        },

        commands: __DIR__.'/../routes/console.php',
        // health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
