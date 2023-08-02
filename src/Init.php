<?php
namespace Larasopp;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Init
{
	public static function postInstall(Event $event)
    {
		//if (file_exists('routes/events.php')) return;
        copy('./files/events.php', 'routes/events.php');
    }
}