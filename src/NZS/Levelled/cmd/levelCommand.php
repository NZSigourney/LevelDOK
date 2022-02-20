<?php

declare(strict_types=1);

namespace NZS\Levelled\cmd;

use pocketmine\command\{Command, CommandSender};
use NZS\Levelled\cmd\SubCommand\HelpSubCommand;
use NZS\Levelled\Provider;
use pocketmine\Player;
use pocketmine\Server;
use NZS\Levelled\Loader;

class levelCommand extends Command
{
    private static $instance = null;

    private Loader $loader;

    private Provider $provider;

    public function getInstance()
    {
        return self::$instance;
    }

    public function __construct(Loader $loader, Provider $provider){
        $this->loader = $loader;
        $this->provider = $provider;

        parent::__construct("level");
        $this->setDescription("Test Beta");
        $this->setUsage("level (help)");
        $this->setPermission("level.command.ic");
    }

    public function getLoader(): Loader
    {
        return $this->loader;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool
    {
        if(!($sender instanceof Player)){
            return true;
        }

        if(!(isset($args[0]))){
            $sender->sendMessage($this->getUsage());
        }

        if($args[0] == "help")
        {
            new HelpSubCommand($sender);
        }elseif($args[0] == "info")
        {
            new InfoSubCommand($sender);
        }elseif($args[0] == "version")
        {
            $sender->sendMessage("§l§c•§a This Version is ".$this->getProvider()->getVersion("Version")." Development by NZS");
        }elseif($args[0] == "top")
        {
            new TopSubCommand($sender);
        }
        return true;
    }
}