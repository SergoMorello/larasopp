<?php

namespace Larasopp;

use Illuminate\Support\Facades\Http;

class Larasopp {
	private static $config;
	private $host;

	public function __construct(array $config) {
		self::$config = $config;
		$this->host = $config['host'];
	}

	public static function trigger($channel, $event, $payload) {
		$response = Http::post(self::$config['host'] . '/channel/' . $channel, [
			'event' => $event,
			'message' => $payload
		]);
		return $response->body();
	}
}