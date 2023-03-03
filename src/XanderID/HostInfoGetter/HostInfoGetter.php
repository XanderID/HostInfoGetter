<?php

namespace XanderID\HostInfoGetter;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;

use pocketmine\utils\Process;
use pocketmine\utils\Utils;

use XanderID\HostInfoGetter\Commands\GetHostInfoCommands;

class HostInfoGetter extends PluginBase{
	
    public function onEnable(): void{
    	$this->saveResource("config.yml");
    
    	$this->getServer()->getCommandMap()->register("HostInfoGetter",  new GetHostInfoCommands($this));
    }
    
    public function sendInfo(CommandSender $sender): bool {
    	if(Utils::getOS() !== Utils::OS_LINUX && Utils::getOS() !== Utils::OS_ANDROID){
    		$sender->sendMessage("§cNow it can only be for Linux and Android OS, for the others, just wait for the update!");
    		return false;
    	}
    	
    	// ALL Information
    	$ramInfo = $this->getRam();
    	$cpuInfo = $this->getCPU();
    	$diskInfo = $this->getDiskSpace();
    
    	$replace = [
    		"{total_ram}" => $ramInfo[0],
    		"{available_ram}" => $ramInfo[1],
    		"{cpu_count}" => $cpuInfo[0],
    		"{total_cpu_load}" => $cpuInfo[1],
    		"{total_space}" => $diskInfo[0],
    		"{available_space}" => $diskInfo[1],
    		"{line}" => PHP_EOL
    	];
    	
    	$sender->sendMessage(str_replace(array_keys($replace), array_values($replace), $this->getConfig()->get("message")));
    	return true;
    }
    
    public function getRam(): array{
    	// Only for get Available Ram
		$info = @file_get_contents('/proc/meminfo');
		$totalRam = 0;
		$availableRam = 0;
    	
    	if(preg_match('/^MemTotal:\s+(\d+)\skB$/m', $info, $matches)){
    		$totalRam = round($matches[1] / 1024 / 1024, 2);
    	}
    	if(preg_match('/^MemAvailable:\s+(\d+)\skB$/m', $info, $matches)){
    		$availableRam = round($matches[1] / 1024 / 1024, 2);
    	}
		
		$totalRam = $totalRam . " GB";
		$availableRam = $availableRam . " GB";
		return [$totalRam, $availableRam];
    }
    
    public function getCPU(): array{
    	// Get CPU Count and Total Cpu Load
		$cpu_load = sys_getloadavg()[0];
		$cpu_count = (int) preg_match_all('/^processor/m', @file_get_contents('/proc/cpuinfo'));
		
		// Convert to Percent
		$cpu_load = round($cpu_load / $cpu_count * 100, 2) . "%";
		return [$cpu_count, $cpu_load];
    }
    
    public function getDiskSpace(): array{
    	// Get Storage Information
		$total_space = round(disk_total_space("/") / (1024 * 1024 * 1024), 2) . " GB";
		$free_space = round(disk_free_space("/") / (1024 * 1024 * 1024), 2) . " GB";
		
		return [$total_space, $free_space];
    }
}
