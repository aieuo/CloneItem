<?php
namespace aieuo;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class cloneItem extends PluginBase {
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
    	if(!isset($args[2]) and !($sender instanceof Player)) return false;

        $from = $sender;
        $to = $sender;

        if(isset($args[2])) {
            $from = $this->getServer()->getPlayer($args[2]);
            if(!($from instanceof Player)) {
                $sender->sendMessage($args[2]."はサーバーにいません");
                return true;
            }
        }

        if(isset($args[1])) {
            $to = $this->getServer()->getPlayer($args[1]);
            if(!($to instanceof Player)) {
                $sender->sendMessage($args[1]."はサーバーにいません");
                return true;
            }
        }

        $item = $from->getInventory()->getItemInHand();

        if(isset($args[0])) {
            if(!is_numeric($args[0]) or (int)$args[0] <= 0) {
                $sender->sendMessage("複製する数は1以上の数字で入力してください");
                return true;
            }
            $item->setCount((int)$args[0]);
        }

    	$to->getInventory()->addItem($item);
    	$sender->sendMessage($from->getName()."のアイテムを".$item->getCount()."個".$to->getName()."に複製しました");
        return true;
    }
}