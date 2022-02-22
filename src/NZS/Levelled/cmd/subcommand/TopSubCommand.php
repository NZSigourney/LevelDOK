<?php

declare(strict_types=1);

namespace NZS\Levelled\cmd;

use JetBrains\PhpStorm\Pure;
use jojoe77777\FormAPI\SimpleForm;
use NZS\Levelled\Loader;
use NZS\Levelled\Provider;
use pocketmine\Player;

class TopSubCommand
{
    private Loader $loader;

    /**
     * @param Loader $loader
     * @param Player $player
     */
    public function __construct(Loader $loader, Player $player)
    {
        $this->loader = $loader;
        $this->loadSubCommand($player);
    }

    public function getLoader(): Loader
    {
        return $this->loader;
    }

    #[Pure] public function getProvider(): Provider
    {
        return $this->getLoader()->getProvider();
    }

    public function loadSubCommand(Player $player)
    {
        if($player->hasPermission("level.command.top")){
            $lv = $this->getProvider()->config->getAll();
            $m = "";
            $m1 = "";
            if(count($lv) > 0)
            {
                arsort($lv);
                $i = 1;
                foreach($lv as $name => $level) {
                    $m .= "§l§3 TOP " . $i . ": §6" . $name . "§d§f " . $level . " §2Level\n\n";
                    $m1 .= "§l§3 TOP " . $i . ": §6" . $name . "§d§f " . $level . " §2Level\n";
                    if ($i >= 10) {
                        break;
                    }
                    ++$i;
                }
            }

            $f = new SimpleForm(Function (Player $player, $data){
                if ($data == null)
                {
                    return;
                }
                switch($data){
                    case 0:
                        $this->loadSubCommand($player);
                        break;
                }
            });
            $f->setTitle($this->getProvider()->tag);
            $f->setContent($m."\n".$m1);
            $f->addButton("Back");
            $f->sendToPlayer($player);
        }else{
            $player->sendMessage($this->getLoader()->getProvider()->getMessage("Level.Permission.exists"));
        }
    }
}