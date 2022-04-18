<?php

namespace ItsToxicGG\FlyDX;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Plugin\PluginBase;

use Vecnavium\FormsUI\CustomForm;

class Main extends PluginBase{
  
  public function onEnable(): void{
      $this->getLogger()->info("FlyDX has been Enabled!");
  }
  
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
      if($cmd->getName() === "fly"){
          if($sender instanceof Player){
              $this->form($sender);
         } else	{
              $sender->sendMessage("§cYou Are Not A Player!");
         }
      }

      return true; 

  }
    
  public function form($player){
      $form = new CustomForm(function(Player $player, array $data){ 
          if($data === null){
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
       
    
