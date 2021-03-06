<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Zizaco\Entrust\Middleware;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'manager' => \App\Http\Middleware\Manager::class, //agregado para asegurar que solo los administradores tengan acceso al area admin
        'medico' => \App\Http\Middleware\Medico::class, //agregado para que solo los que tengan el rol de medico puedan ver y editar historias clinicas
    ];
}
