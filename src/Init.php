<?php
namespace Larasopp;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Init
{
	public static function postInstall(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
		dd(123);
        copy($vendorDir . '/larasopp/larasopp/files/events.php', 'routes/events.php');

		
    }
}