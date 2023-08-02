<?php

use Larasopp\LarasoppEvents;
use Larasopp\Larasopp;

LarasoppEvents::listen('channel', 'event', function($data) {

	Larasopp::trigger('channel', 'event', [
		'message' => $data['message'] ? ''
	]);

});