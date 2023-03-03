<?php

namespace XanderID\HostInfoGetter\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;
use XanderID\HostInfoGetter\HostInfoGetter;

class GetHostInfoCommands extends Command implements PluginOwned {
	
	/** @var HostInfoGetter $plugin */
	private $plugin;
	
	public function __construct(HostInfoGetter $plugin){
		$this->plugin = $plugin;
        parent::__construct("gethostinfo", "Get All Information from Host", "/gethostinfo", ["hostinfo"]);
        $this->setPermission("gethostinfo.cmd");
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
    	if (!$this->testPermission($sender)) return false;
    
    	$this->getOwningPlugin()->sendInfo($sender);
        return true;
	}
	
	public function getOwningPlugin(): HostInfoGetter{
        return $this->plugin;
    }
}
