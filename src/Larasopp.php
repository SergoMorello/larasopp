<?php

namespace Larasopp;

use Illuminate\Support\Facades\Http;

class Larasopp {
	private static string $driver,
		$host;
	public string $channel,
		$event;
	public $message;

	public function __construct(array $data) {
		(isset($data['driver']) && empty(self::$driver)) ? self::$driver = $data['driver'] : null;
		(isset($data['host']) && empty(self::$host)) ? self::$host = $data['host'] : null;
		
		$this->channel = $data['channel'] ?? '';
		$this->event = $data['event'] ?? '';
		$this->message = $data['message'] ?? '';
	}

	public static function trigger($channel, $event, $payload) {
		$response = Http::post(self::$host . '/channel/' . $channel, [
			'event' => $event,
			'message' => $payload
		]);
		return $response->body();
	}

	public static function subscribe(string $channel): Subscribe {
		return new Subscribe($channel);
	}
}