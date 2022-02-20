<?php

declare(strict_types=1);

namespace NZS\Levelled\events\update;

use Exception;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use pocketmine\utils\Internet;

class UpdateChecker extends AsyncTask
{

    public function onRun(): void
    {
        // TODO: Implement onRun() method.
        $this->setResult([Internet::getURL()]);
    }
}