<?php

declare(strict_types=1);

namespace NZS\Levelled;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Loader extends PluginBase{
    public Provider $provider;

    public function onEnable(): void
    {
        $this->provider = new Provider();
        $this->provider->open();

        if ($this->getProvider()->getVersion("Version") == 1.0) {
            $this->getServer()->getLogger()->notice("Version 1.0 - Beta");
        }else{
            $this->getServer()->disablePlugins();
        }
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }

    public function onLoad(): void
    {
        $this->getServer()->getLogger()->notice("\n-=======- Levels DOK -=======-\n Translate & Code by NZS");
    }
}