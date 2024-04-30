<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Teacher;
use App\Http\Middleware\expert;
use App\Http\Middleware\Student;
use App\Http\Middleware\Guest;
use App\Http\Middleware\admin;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'expert'=>expert::class,
            'teacher'=>Teacher::class,
            'student'=>Student::class,
            'guest'=>Guest::class,
            'admin'=>admin::class,
            
           
        ]);
    

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
