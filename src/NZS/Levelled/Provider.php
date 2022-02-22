<?php

declare(strict_types=1);

namespace NZS\Levelled;

use pocketmine\Server;
use pocketmine\Player;
//use pocketmine\player\Player; TODO: USED FOR API 4.2.0
use pocketmine\utils\Config;

class Provider
{
    public Config $config;
    //public Config $money;
    public Config $message;

    public Config $version;

    public string $tag = "§l§f-====§a Level¶cDOK§f ====-";

    public function __construct()
    {
        // TODO: CONSTRUCT EXECUTE
    }

    public function open(){
        $this->config = new Config($this->getLoader()->getDataFolder() . "recipes.yml", Config::YAML);
        $this->getLoader()->saveResource("Message.yml");
        $this->getLoader()->saveResource("Version.yml");
        $this->message = new Config($this->getLoader()->getDataFolder() . "Message.yml", Config::YAML);
        $this->version = new Config($this->getLoader()->getDataFolder() . "Version.yml", config::YAML);
    }

    public function getLoader(): ?Loader
    {
        $main = Server::getInstance()->getPluginManager()->getPlugin("LevelDOK");
        if($main instanceof Loader){
            return $main;
        }
        return null;
    }

    public function save()
    {
        $this->config->save();
    }

    public function setProvider(Player $player, int $level, int $exp)
    {
        $this->config->set($player, ["Level" => $level, "EXP" => $exp]);
        $this->save();
    }

    public function getProviderLeveled(Player $player, string $name)
    {
        return $this->config->get($player->getName())[$name];
    }

    public function changeProvider(string $str){
        return $this->config[$str];
    }

    public function removeProviderLeveled(string $PlayerName, array $keys)
    {
        $file = $this->config;
        $getPlayer = $file->get($PlayerName, []);
        $id = array_search($keys, $getPlayer);
        unset($getPlayer[$id]);
    }

    public function joinProvider(Player $player)
    {
        $array = ["Level" => 0, "EXP" => 0];
        $this->config->set($player->getName(), $array);
    }

    public function addEXP(Player $player, $exp)
    {
        $expr = $this->config->get($player->getName())["EXP"];
        //$this->config->set($player->getName(), $expr + $exp);
        $this->config->setNested("EXP", $expr + $exp);
        $this->save();
    }

    public function addLevels(PLayer $player, $level)
    {
        $leveled = $this->config->get($player->getName())["Level"];
        //$this->config->set($player->getName(), $leveled + $level);
        $this->config->setNested("Level", $leveled + $level);
        $this->save();
    }

    public function getMessage(string $msg)
    {
        return $this->message->get($msg);
    }

    public function getVersion(string $string)
    {
        return $this->version->get($string);
    }
}