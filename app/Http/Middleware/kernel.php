protected $routeMiddleware = [
    // Otros middlewares...
    'auth' => \App\Http\Middleware\Authenticate::class,
    'checkRole' => \App\Http\Middleware\CheckRole::class, // Asegúrate de que esto esté configurado
];
