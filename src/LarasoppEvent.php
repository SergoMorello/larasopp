<?php
namespace Larasopp;

use Illuminate\Support\Facades\Event;

class LarasoppEvent {

	public $channel;

	public $event;

	public $message;

	public function __construct(array $data) {
		$this->channel = $data['channel'];
		$this->event = $data['event'];
		$this->message = $data['message'];
	}

	public static function listen(string $channel, string $event, \Closure $callback) {
		Event::listen('larasopp-' . $channel . '-' . $event, function (...$args) use (&$callback) {
			$data = count($args) > 1 ? (end($args)[0] ?? null) : ($args[0] ?? null);
			$callback($data);
		});
	}

}