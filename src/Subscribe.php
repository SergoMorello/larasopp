<?php
namespace Larasopp;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class Subscribe extends Controller {
	private array $callbacks = [];
	private string $channel;
	public function __construct(string $channel = '') {
		$this->channel = $channel;
	}

	public function bind(string $event, \Closure $callback): self {
		if (!isset($this->callbacks[$event])) $this->callbacks[$event] = [];
		
		array_push($this->callbacks[$event], function($eventData) use (&$callback) {
			return $callback($eventData);
		});

		Route::post('/trigger/' . $this->channel . '/' . $event, function(Request $req) use (&$event) {
			$eventData = new Larasopp($req->json()->all() ?? []);
			return array_map(function($callback) use (&$eventData) {
				return $callback($eventData);
			},$this->callbacks[$event]);
		});
		return $this;
	}
}