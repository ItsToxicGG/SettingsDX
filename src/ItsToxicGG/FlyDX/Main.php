<?php

namespace ItsToxicGG\FlyDX;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;

use Vecnavium\FormsUI\CustomForm;

class Main extends PluginBase{
  
  public function onEnable(): void{
      $this->getLogger()->info("FlyDX has been Enabled!");
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
      switch($cmd->getName()){
        case "ui":
          if($sender->hasPermission("fly.cmd")){
            if(!$sender instanceof Player){
              $sender->sendMessage("This Command Only Works for players! Please perform this command IN GAME!");
            }else{
              $this->form($sender);
            }
          }
        break;
      }
      return true;
  }
    
  public function form($player){
      $form = new CustomForm(function(Player $player, array $data){ 
          if($data === null){
              return
          }
          switch($data[1]){
              case true:
                  $player->setFlying(true);
                  $player->setAllowFlight(true);
                  $player->sendMessage("§aFly Is Active");
              break;

              case false:
                  $player->setFlying(false);
                  $player->setAllowFlight(false);
                  $player->sendMessage("§cFly is Not Active"); 
              break;
        }
            
      });
      $form->setTitle("FlyDX UI");
      $form->addLabel("FlyDX Settings, Off OR On");
      $form->addToggle("Toggle Fly", false);
      $form->sendToPlayer($player);
      return $form;
  }
} 
       
    
