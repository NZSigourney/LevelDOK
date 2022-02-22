<?php

namespace NZS\Levelled\cmd\subcommand;

use NZS\Levelled\Loader;
use NZS\Levelled\Provider;
use pocketmine\Player;
use pocketmine\Server;

class HelpSubCommand
{
    private Provider $provider;

    private static $instance = null;

    public static function getInstance()
    {
        return self::$instance;
    }

    public function __construct(Player $player)
    {
        // TODO: implements Construct
        $this->loadSubCommand($player);
    }

    private function getLoader(): ?Loader
    {
        $loader = Server::getInstance()->getPluginManager()->getPlugin("LevelDOK");
        if ($loader instanceof Loader){
            return $loader;
        }
        return null;
    }

    private function loadSubCommand(Player $player)
    {
        if ($player->hasPermission("Level.Command.Help"))
        {
            $player->sendMessage("§l§a-====== " . Server::getInstance()->getMotd() . "§l§a ======-");
            $player->sendMessage("§l§aSubCommand: help, info, top");
        }else{
            $player->sendMessage($this->getLoader()->getProvider()->getMessage("Level.Permission.exists"));
        }
    }

    /**public function canUse(CommandSender $player): bool
    {
        return ($player instanceof Player) and $player->hasPermission("Level.Command.Help");
    }

    public function execute(CommandSender $sender,string $commandLabel, array $args): bool
    {
        if(!($sender instanceof Player)){
            throw new CommandException("Invalid Command", 19);
        }
        if($sender->hasPermission("Level.command.help")){
            $sender->sendMessage("Updating");
        }else{
            //$sender->setHealth(5.2);
            $sender->sendMessage("Do not have Level.command.Help Permission for Command!");
        }
        return true;
    }*/
}