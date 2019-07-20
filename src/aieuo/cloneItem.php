<?php
namespace aieuo;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class cloneItem extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }

    public function onCommand(CommandSender $sender, Command $command,string $label, array $args):bool{
    	if(!($sender instanceof Player))return false;
    	$sender->getInventory()->addItem($sender->getInventory()->getItemInHand());
    	$sender->sendMessage("複製しました");
        return true;
    }
}