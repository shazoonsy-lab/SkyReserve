<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    // ✅ كل الـ middleware في مكان واحد فقط
    ->withMiddleware(function (Middleware $middleware): void {

        // aliases
        $middleware->alias([
            'admin'    => \App\Http\Middleware\AdminMiddleware::class,
            'employee' => \App\Http\Middleware\EmployeeMiddleware::class,
            'user'     => \App\Http\Middleware\UserMiddleware::class,
        ]);

        // CSRF exception للـ Stripe
        $middleware->validateCsrfTokens(except: [
            'webhooks/stripe',
        ]);
    })

    // ✅ هذا كان مفقود (سبب الخطأ)
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();
