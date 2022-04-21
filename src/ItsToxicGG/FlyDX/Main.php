<?php

namespace ItsToxicGG\FlyDX;

use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityTeleportEvent;
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
  
  private function MWCheck(Entity $entity) : bool{
      if(!$entity instanceof Player) return false;
      if($this->getConfig()->get("multi-world") === "on"){
	  if(!in_array($entity->getWorld()->getDisplayName(), $this->getConfig()->get("worlds"))){
	      $entity->sendMessage("§cThis world does not allow flight");
		if(!$entity->isCreative()){
	            $entity->setFlying(false);
		    $entity->setAllowFlight(false);
		}
		return false;
	  }
      }elseif($this->getConfig()->get("multi-world") === "off") return true;
		  return true;
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
      switch($cmd->getName() === "fly"){
        case "ui":
          if($sender->hasPermission("fly.cmd")){
            if(!$sender instanceof Player){
              $sender->sendMessage("§cThis Command Only Works In-Game!");
            }else{
              $this->FormSettings($sender);
            }
          }
        break;
      }
      return true;
  }
  
  public function onLevelChange(EntityTeleportEvent $event) : void{
      $entity = $event->getEntity(); 
      if($entity instanceof Player) $this->MWCheck($entity);
  }
    
  public function FormSettings($player){
      $form = new CustomForm(function(Player $player, $data){ 
          if($data === null){
              return true;
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
       
    
