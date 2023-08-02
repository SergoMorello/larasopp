<?php
namespace Larasopp;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Laravel\Sanctum\PersonalAccessToken;

class LarasoppEvents extends Route {
	
	/**
	 * Listen on socket events
	 *
	 * @param  string $channel
	 * @param  string $event
	 * @param  Closure|string $callback
	 * @return void
	 */
	public static function listen($channel, $event, $callback) {
		Route::post('/trigger/' . $channel . '/' . $event, function(...$args) use (&$callback) {
			self::systemAuth();
			return $callback(request()->json()->all());
		});
	}

	public static function getMessageRaw($name = null) {
		$message = json_decode(request()->getContent());
		if ($name) {
			return $message->$name ?? null;
		}
		return $message;
	}

	private static function systemAuth() {
		// if ($user = self::user()) {
		// 	Auth::loginUsingId($user->id);
		// }
	}

	public static function message($name = null) {
		$message = self::getMessageRaw('message');
		if ($name) {
			return $message->$name ?? null;
		}
		return $message;
	}

	public static function token() {
		return self::getMessageRaw('token');
	}

	public static function user() {
		// $token = PersonalAccessToken::findToken(self::token());
		// if ($token) {
		// 	return $token->tokenable;
		// }
	}
}