<?php

namespace Larasopp;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;


class LarasoppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->resolving(ExceptionHandler::class, function ($handler) {

		});
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Broadcast::routes([
			"middleware" => ['auth:api']
		]);

        Broadcast::extend('larasopp', function (Application $app, array $config) {
			return new LarasoppBroadcaster(new Larasopp($config));
		});
		
		Route::prefix('broadcasting')
			->namespace('\Larasopp')
			->middleware(['auth:api', LarasoppMiddleware::class])
			->post('trigger', LarasoppController::class);
		
		require base_path('routes/channels.php');
    }
}
