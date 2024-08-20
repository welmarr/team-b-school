<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*Response::macro('handle419', function ($request, $response) {
            if ($response->getStatusCode() === 419) {
                // Inject a JavaScript snippet to refresh the page
                $response->setContent(
                    $response->getContent() . '<script>setTimeout(function(){ location.reload(); }, 1000);</script>'
                );
            }

            return $response;
        });

        // Add middleware to check responses
        app('router')->aliasMiddleware('check419', function ($request, $next) {
            $response = $next($request);
            return Response::checkFor419($request, $response);
        });*/
    }
}
