<?php

namespace ItsToxicGG\DxSettings;
// Pocketmine-MP
use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
// Custom Form
use Vecnavium\FormsUI\CustomForm;
// Simple Form
use Vecnavium\FormsUI\SimpleForm;

class Main extends PluginBase{
   
   public function onLoad(): void{
       $this->getLogger()->info("§6Loading DxSettings");
   }
   
   public function onEnable(): void{
      $this->getLogger()->info("§aEnabled DxSettings");
      $this->getLogger()->info("§cWarning: This is an In-Dev + Recode Version");
   }
      
   public function onDisable(): void
       $this->getLogger()->info("§cDisabled DxSettings");
       $this->getLogger()->info("§4This might be caused by an error, pls contact or report an issue on github!");
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
	                $player->sendMessage("§6This option is Comming Soon!");
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
         $form->addButton("§aFly Settings");
         $form->addButton("§cNickName Settings");
         $form->addButton("§cNickColor Settings");
         $form->addButton("§cChatColor Settings");
         $form->addButton("§cExit");
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
         $form->setTitle("§cFly Settings");
         $form->addLabel("§aFly Settings, §6Powered by DX/DCTX");
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
				
		    case 3:
		        $player->setDisplayName("§a" . $player->getName() . "§f");
		        $player->setNameTag("§a" . $player->getName() . "§f");
			$player->sendMessage("§aYour Name has been change to Green!");
	            break;
	        }
	      return true;
	      });
	        $form->setTitle("§6NickName-Color §cSettings");
	        $form->setContent("§fSelect a color to your nickname!");
	        $form->addButton("§fWhite");
	        $form->addButton("§cRed");
	        $form->addButton("§bBlue");
	        $form->addButton("§aGreen");
	        $form->sendToPlayer($player);
	        return $form;
   }
}
