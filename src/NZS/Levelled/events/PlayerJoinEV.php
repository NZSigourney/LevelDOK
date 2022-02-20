<?php

declare(strict_types=1);

namespace NZS\Levelled\events;

use pocketmine\event\player\PlayerJoinEvent;
use NZS\Levelled\Loader;
use NZS\Levelled\Provider;
use pocketmine\{Player, Server};
//use pocketmine\player\Player;
use pocketmine\event\Listener;

class PlayerJoinEV implements Listener
{
    private static $instance = null;

    private Loader $loader;

    public static function getInstance()
    {
        return self::$instance;
    }

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function getLoader(): Loader
    {
        return $this->loader;
    }

    public function onJoin(PlayerJoinEvent $ev)
    {
        $player = $ev->getPlayer();
        $this->getLoader()->getProvider()->joinProvider($player);
    }
}