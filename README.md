# Larasopp

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
		'host' => 'ws://127.0.0.1:3001',
		'token' => '1234'
	],
...
```

#### routes/events.php
```php
<?php

use Larasopp\Larasopp;

$listener = Larasopp::subscribe('channel');

$listener->bind('event', function(Larasopp $data){

	Larasopp::trigger('channel', 'event', [
		'message' => $data->message
	]);

});

```

#### .env
```conf
BROADCAST_DRIVER=larasopp
```