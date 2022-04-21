<?php

namespace ItsToxicGG\DxSettings;

use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use Vecnavium\FormsUI\CustomForm;
use Vecnavium\FormsUI\SimpleForm;

class Main extends PluginBase implements Listener{
  
  public function onEnable(): void{
      $this->getLogger()->info("§aFlyDX has been Enabled!");
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
      @mkdir($this->getDataFolder());
      $this->saveDefaultConfig();
  }
	
  public function onLoad(): void{
      $this->getLogger()->info("§6FlyDX is Loading...");
  }
	
  public function onDisable(): void{
      $this->getLogger()->info("§cFlyDX has disabled");
      $this->getLogger()->info("§cThe Plugin may have an issue or the server closed!");
  }
  
  private function MWCheck(Entity $entity) : bool{
      if(!$entity instanceof Player) return false;
      if($this->getConfig()->get("MW-SUPPORT") === "on"){
	  if(!in_array($entity->getWorld()->getDisplayName(), $this->getConfig()->get("Worlds"))){
	      $entity->sendMessage("§cThis world does not allow flight");
		if(!$entity->isCreative()){
	            $entity->setFlying(false);
		    $entity->setAllowFlight(false);
		}
		return false;
	  }
      }elseif($this->getConfig()->get("MW-SUPPORT") === "off") return true;
		  return true;
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
      switch($cmd->getName() === "settings"){
        case "ui":
          if($sender->hasPermission("dxsettings.cmd")){
            if(!$sender instanceof Player){
              $sender->sendMessage("§cThis Command Only Works In-Game!");
            }else{
              $this->DxSettings($sender);
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
	
 public function onJoin(PlayerJoinEvent $event) : void{
     $player = $event->getPlayer();
     if($this->getConfig()->get("onJoin-FlyReset") === true){
	if($player->isCreative()) return;
	$player->setAllowFlight(false);
	$player->sendMessage($this->getConfig()->get("fly-disabled"));
	}
 }
	
	
  public function DxSettings($player){ 
      $form = new SimpleForm(function(Player $player, $data){
	  if($data === null){
	      return true;
	  }
	      
	  switch($data){
	      case 0:
		  $this->FlySettings($player);
	          $player->sendMessage("§6Loading FlyForm...");
	      break;
	      
	      case 1:
		  $player->sendMessage("§6This option is Comming Soon!");	
	      break;
			  
	      case 2:
	          $this->NickColorSettings($player);
	          $player->sendMessage("§6Loading NCForm...");
	      break;
			  
	      case 3:
	          $player->sendMessage("§6This option is Comming Soon!");
	      break;
			  
	      case 4:
	          $player->sendMessage("§cYou Have Closed The Form!");
	      break;  
	  }
      });
      $form->setTitle("Settings");
      $form->setContent("DX Settings");
      $form->addButton("Fly Settings");
      $form->addButton("NickName Settings");
      $form->addButton("NickColor Settings");
      $this->addButton("ChatColor Settings");
      $form->addButton("Exit");
      $form->sendToPlayer($player);
      return true;
  }
    
  public function FlySettings($player){
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
	
  public function NickColorSettings(Player $player){
      $form = new SimpleForm(function (Player $player, $data = null){
	  if($data === null){
	      return true;
	  }
	  switch($data){
	      case 0:
		  $player->setDisplayName("§f" . $player->getName() . "§f");
		  $player->setNameTag("§f" . $player->getName() . "§f");
		  $player->sendMessage("§aYour Name has been change to white!");
	      break;

	      case 1:
		  $player->setDisplayName("§c" . $player->getName() . "§f");
	          $player->setNameTag("§c" . $player->getName() . "§f");
		  $player->sendMessage("§aYour Name has been change to Red!");
	      break;

	      case 2:
		  $player->setDisplayName("§b" . $player->getName() . "§f");
		  $player->setNameTag("§b" . $player->getName() . "§f");
		  $player->sendMessage("§aYour Name has been change to Blue!");
	      break;
	  }
	return true;
	});
	$form->setTitle("NickName-Color Settings");
	$form->setContent("Select a color to your nickname!");
	$form->addButton("White");
	$form->addButton("§cRed");
	$form->addButton("§bBlue");
	$form->sendToPlayer($player);
	return $form;
  }

}

       
    
