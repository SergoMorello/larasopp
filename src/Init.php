<?php
namespace Larasopp;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Init
{
	public static function postInstall(PackageEvent $event)
    {
        //copy('vendor/larasopp/larasopp/files/events.php', 'routes/events.php');
		file_put_contents('test.txt', __DIR__);

    }
}