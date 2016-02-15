<?php

namespace Hittmana\TradePro;
/*
 *   ________     _____      ____     _____    _______           _____     _____    ______
 * //__    __\\  //___\\    //  \\    || \ \   ||_____|          | __ \   //___\\  / /  \ \
 *    ||  ||    ||____//   //____\\   ||  \ \  ||_____  _______  ||__||  ||____//  | |  | |
 *    ||  ||    ||\\      /________\  ||   ||  ||_____| |_____|  |____/  ||\\      | |  | |
 *    ||  ||    || \\    ||        || ||___//  ||_____           | |     || \\     | \__/ |
 *    ||__||    ||  \\   ||        || |____/   ||_____|          |_|     ||  \\    \______/
 *    
 *      VERSION 0.3.5
 * 
 *      TradePro was created by @Hittmana to aid the process of trading on PocketMine servers.
 *     By using TradePro you will allow your users to easily and safely trade items without 
 *     having to worry about the other person lying and not giving the items they said they would.
 *     TradePro can also be found on GitHub and if you wish you can send a fork request to add to
 *     this project. Please ask if you do wish to fork this to use in your own project.
*/                        

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\item\Item;

class MainClass extends PluginBase implements Listener{
    public function onEnable(){
        $this->getLogger()->info("TradePro enabled v0.3.5");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        }
        
    public function onDisable(){
        $this->getLogger()->info("TradePro disabled v0.3.5zx");
        }
        
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        if($sender instanceof Player){
            $name = $sender->getName();
                if ($command->getName() == "trade") {
                    $this->getLogger()->info("[TradePro]" . "IT WORKS!!" . $name . "USED IT!!!!");
                    $recipient = $this->getServer()->getPlayer($args[0]);
                        if($recipient instanceof Player){
                            $trader = $sender->getName();
                            $recipient->sendMessage("[TradePro]" . $trader . " wants to trade with you!");  
                            $sender->sendMessage("[TradePro]" . "You sent a trade request " . $recipient . ". Lets hope they say YES!");
                            $item1 = $args[1];
                            $amount1 = $args[2];
                            $item2 = $args[3];
                            $amount2 = $args[4];
                            return true;
                            }
                            else{
                                 $this->getLogger()->info("Must be run ingame!");
                                return false;
                        // /trade 0<player> 1<item youll trade> 2<amount youll trade> 3<what you want> 4<amount you want>
                            }
            if ($command->getName() == "tradeaccept"){
                    $sender->sendMessage("[TradePro]" . "You accepted trade request from " . $trader);
                    $trader->sendMessage("[TradePro]" . $sender . " accepted!");
                    $player = $sender;
                    $player->getInventory()->setItem(0, Item::get($item1,0,$amount1));
                    $this->getServer()->getPlayer($trader)->getInventory()->removeItem(Item::get($item1, 0, $amount1));
                    $trader->sendMessage("[TradePro]" . "You traded " . $item1 . "x" . $amount1 . "with " . $player);  
                    $player->sendMessage("[TradePro]" . "You traded " . $item2 . "x" . $amount2 . "with " . $trader);
                    $trader->getInventory()->setItem(0, Item::get($item2,0,$amount2));
                    $this->getServer()->getPlayer($player)->getInventory()->removeItem(Item::get($item2, 0, $amount2));
                return true;
                }
            if ($command->getName() == "tradedecline"){
                    $sender->sendMessage("[TradePro]" . "You declined the trade request from " . $trader);
                    $trader->sendMessage("[TradePro]" . $sender . " declined your trade request");
                    return true;
                }   
        } 
    }   
  return false;
  }
}
