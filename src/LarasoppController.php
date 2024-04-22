<?php

namespace Larasopp;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event as LaravelEvent;

class LarasoppController extends Controller {

	public function __invoke(Request $request) {
		if (!$request->has('channel', 'event')) return;
		
		$data = new LarasoppEvent([
			'message' => $request->message,
			'channel' => $request->channel,
			'event' => $request->event
		]);

		LaravelEvent::dispatch('larasopp-' . $request->channel . '-'. $request->event, $data);
	}
}