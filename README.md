# Larasopp

## Websocket event emitter for laravel

### Install

```shell
composer require larasopp/larasopp
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