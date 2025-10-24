<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Http\Request;
use Illuminate\Console\Scheduling\Schedule; // 1. IMPORTANTE: Incluir a classe Schedule

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    // 2. ADICIONAR O AGENDAMENTO AQUI
    ->withSchedule(function (Schedule $schedule) {
        // Este comando diz ao Laravel: "Rode o worker da fila por um ciclo a cada 2 minutos."
        // Isso corresponde à sua configuração '*/2 * * * *' no Cron Job da Hostinger.
        $schedule->command('queue:work --stop-when-empty')->everyTwoMinutes(); 
    })
    
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));
    })
    ->withMiddleware(function (Middleware $middleware) { 
        $middleware->redirectUsersTo(fn (Request $request) => route('home'));
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectUsersTo('/');
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
    })->create();
