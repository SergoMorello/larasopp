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

	public function bind(string $event, \Closure $callback) {
		array_push($this->callbacks, function($eventData) use (&$callback) {
			return $callback(new Larasopp($eventData));
		});
		Route::post('/trigger/' . $this->channel . '/' . $event, function(Request $req) {
			$eventData = $req->json()->all() ?? [];
			
			return array_map(function($callback) use (&$eventData) {
				return $callback($eventData);
			},$this->callbacks);
		});
	}
}