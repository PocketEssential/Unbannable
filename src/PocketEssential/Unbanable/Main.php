<?php
namespace PocketEssential\Unbanable;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{
    public $cmds = ["ban", "ban-ip", "bancid", "bancidbyname", "banipbyname"];
    
    public function onEnable(){
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN . "Unbanable by PocketEssential has been enabled!");
    }
    
    public function onPreProcess(PlayerCommandPreprocessEvent $ev){
        $p = $ev->getPlayer();
        $m = $ev->getMessage();
        $e = explode(" ", $m);
        if($m[0] == "/"){
			$c = substr($e[0], 1);
			if(in_array($c, $this->cmds)){
				foreach($this->getConfig()->get("unbanables") as $unb){
					if($unb == $e[1]){
						$p->sendMessage(TextFormat::RED . "You can't ban that player!");
						$ev->setCancelled(true);
					}
				}
			}
		}
	}
}