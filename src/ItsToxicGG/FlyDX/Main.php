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
      switch ($command->getName()){
          case "fly"
            $sender->sendMessage("This command is currently not to use!");
          break;
  }
    
  public function form($player){
      $form = new CustomForm(function(Player $player, array $data)){ 
          if($data === null){
            case true;
            
            break;
            
            case false;
            
            break;
            return true;
          }
      });
      $form->setTitle("FlyDX UI");
      $form->addLabel("FlyDX Settings, Off OR On");
      $form->addToggle("Toggle Fly", false);
      $form->sendToPlayer($player);
      return $form;
       
    
