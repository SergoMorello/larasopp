<?php

namespace Larasopp;

use WebSocket\Client;

class Larasopp {
	private static string $driver,
		$host,
		$token;
	public string $channel,
		$event;
	public $message;

	public function __construct(array $data) {
		(isset($data['driver']) && empty(self::$driver)) ? self::$driver = $data['driver'] : null;
		(isset($data['host']) && empty(self::$host)) ? self::$host = $data['host'] : null;
		(isset($data['token']) && empty(self::$token)) ? self::$token = $data['token'] : '';
		
		$this->channel = $data['channel'] ?? '';
		$this->event = $data['event'] ?? '';
		$this->message = $data['message'] ?? '';
	}

	public static function trigger($channel, $event, $payload) {
		$client = new Client(self::$host . '/controll_token=' . self::$token);
		$channelSplit = explode('-', $channel, 2);
		$type = 'public';
		$channel = $channelSplit[0];
		if (count($channelSplit) > 1) {
			$type = $channelSplit[0];
			$channel = $channelSplit[1];
		}
		$client->send(json_encode([
			'type' => $type,
			'channel' => $channel,
			'event' => $event,
			'message' => $payload
		]));
		$client->close();
	}
}