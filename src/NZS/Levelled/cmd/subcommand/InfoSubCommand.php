<?php

declare(strict_types=1);

namespace NZS\Levelled\cmd;


use jojoe77777\FormAPI\CustomForm;
use NZS\Levelled\Loader;
use pocketmine\Player;
use pocketmine\Server;

class InfoSubCommand
{

    private static $instance = null;

    /**
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->loadSubCommand($player);
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public function getLoader(): ?Loader
    {
        $loader = Server::getInstance()->getPluginManager()->getPlugin("LevelDOK");
        if ($loader instanceof Loader)
        {
            return $loader;
        }
        return null;
    }

    public function getCommand(): ?levelCommand
    {
        $command = Server::getInstance()->getPluginManager()->getPlugin("LevelDOK");
        if ($command instanceof levelCommand)
        {
            return $command;
        }
        return null;
    }

    private function loadSubCommand(Player $player)
    {
        if($player->hasPermission("level.command.info")){
            $level = $this->getLoader()->getProvider()->getProviderLeveled($player, "Level");
            $exp = $this->getLoader()->getProvider()->getProviderLeveled($player, "EXP");
            $f = new CustomForm(Function (Player $playerName, $data){
            });
            $f->setTitle(Server::getInstance()->getPluginManager()->getPlugin("LevelDOK")->getName());
            $f->addLabel("§l§aYour Level: ". $level);
            $f->addLabel("§l§aYour EXP: ". $exp);
            $f->sendToPlayer($player);
        }else{
            $player->sendMessage($this->getLoader()->getProvider()->getMessage("Level.Permission.exists"));
        }
    }
}