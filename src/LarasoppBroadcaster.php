<?php

namespace Larasopp;

use Illuminate\Broadcasting\Broadcasters\Broadcaster;

use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;

class LarasoppBroadcaster extends Broadcaster
{
	
	/**
	 * Instance Larasopp
	 *
	 * @var Larasopp
	 */
	protected $larasopp;

	
    public function __construct(Larasopp $larasopp)
    {
		$this->larasopp = $larasopp;
    }

    /**
     * Authenticate the incoming request for a given channel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
     */
    public function auth($request)
    {
		$channelName = $request->channel;
		
		if (empty($request->channel) ||
            ! $this->retrieveUser($request, $channelName)) {
            throw new AccessDeniedHttpException;
        }
		
        return parent::verifyUserCanAccessChannel(
            $request, $channelName
        );
    }

    /**
     * Return the valid authentication response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $result
     * @return mixed
     */
    public function validAuthenticationResponse($request, $result)
    {
		return is_bool($result) ? ['success' => $result] : $result;
    }

    /**
     * Broadcast the given event.
     *
     * @param  array  $channels
     * @param  string  $event
     * @param  array  $payload
     * @return void
     *
     * @throws \Illuminate\Broadcasting\BroadcastException
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
		array_map(function($channel) use (&$event, &$payload){
			$this->larasopp->trigger($channel, $event, $payload);
		},$channels);
    }
}
