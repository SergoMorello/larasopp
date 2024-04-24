# Larasopp

#### Server
```
https://github.com/SergoMorello/larasopp.server
```
#### JS Client
```
npm i larasopp
```

## Websocket event emitter for laravel

### Install

```shell
composer require larasopp/larasopp
```

#### config/broadcasting.php
```php
...
'connections' => [

	'larasopp' => [
		'driver' => 'larasopp',
		'host' => env('LARASOPP_HOST', 'ws://127.0.0.1:3001'),
		'key' => env('LARASOPP_key', 'key')
	],
...
```

#### app\Providers\EventServiceProvider.php
```php
use Larasopp\LarasoppEvent;

class EventServiceProvider extends ServiceProvider
{
	...
	
	 /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
 		LarasoppEvent::listen('channel', 'event', function (LarasoppEvent $event) {
			// $event->message
		});

		// OR
		LarasoppEvent::listen('channel', '*', function (LarasoppEvent $event) {
			// $event->event
			// $event->message
		});
	}

```
#### config/auth.php
```php
'guards' => [
	'api' => [
		'driver' => 'sanctum',
		'provider' => 'users',
		'hash' => true,
	],
	...
```

#### .env
```conf
BROADCAST_DRIVER=larasopp
```
