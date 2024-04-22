<?php

namespace Larasopp;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;

class LarasoppController extends Controller {

	public function __invoke(Request $request) {
		if (!$request->has('channel', 'event')) return;
		Event::dispatch('larasopp-' . $request->channel . '-'. $request->event, [$request->message]);
	}
}