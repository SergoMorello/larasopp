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
			'host' => 'http://127.0.0.1:8123'
        ],
...
```

#### routes/events.php
```php
<?php

use Larasopp\LarasoppEvents;
use Larasopp\Larasopp;

LarasoppEvents::listen('channel', 'event', function($data) {

	Larasopp::trigger('channel', 'event', [
		'message' => $data['message'] ? ''
	]);

});
```