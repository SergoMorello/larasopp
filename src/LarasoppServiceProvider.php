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
			// $handler->renderable(function (\Throwable $e, $request) {
			// 	if ($request->is('broadcasting/*')) {
			// 		return response()->json([
			// 			'success' => false,
			// 			'message' => $e->getMessage()
			// 		], 500);
			// 	}
			// });
		});
		// $exceptionHandler = resolve(ExceptionHandler::class);
		// $exceptionHandler->renderable(function (\Throwable $e, $request) {
		// 	if ($request->is('broadcasting/*')) {
		// 		return response()->json([
		// 			'success' => false,
		// 			'message' => $e->getMessage()
		// 		], 500);
		// 	}
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Broadcast::routes([
			"middleware" => ['api']
		]);

        Broadcast::extend('larasopp', function (Application $app, array $config) {
			return new LarasoppBroadcaster(new Larasopp($config));
		});
		
		$eventsPath = base_path('routes/events.php');
		
		if (file_exists($eventsPath)) {
			Route::prefix('broadcasting')
				->middleware('api')
				->namespace('\Larasopp')
				->group($eventsPath);
		}
		
		require base_path('routes/channels.php');
    }
}
