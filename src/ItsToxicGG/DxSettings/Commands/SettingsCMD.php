<?php

namespace ItsToxicGG\DxSettings\Commands;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;

use ItsToxicGG\DxSettings\Main;

class SettingsCMD extends Command implements PluginOwned{
    
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        
        parent::__construct("settings", "§fServer Settings Powered with DxSettings", "§bUsage: /settings", ["settings"]);
        $this->setPermission("settings.dx");
        $this->setAliases(["sdx"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(count($args) == 0){
            if($sender instanceof Player) {
                $this->plugin->DxSettings($sender);
            } else {
                $sender->sendMessage("§cUse this command in-game!");
            }
        }
        return true;
    }
    
    public function getPlugin(): Plugin{
        return $this->plugin;
    }

    public function getOwningPlugin(): Loader{
        return $this->plugin;
    }
}
