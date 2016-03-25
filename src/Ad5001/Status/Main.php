<?php
namespace Ad5001\Status;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\IPlayer;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{
  public function onEnable(){
    $this->saveDefaultConfig();
    $this->reloadConfig();
	$plcfg = new Config($this->getDataFolder() . "players/Ad5001.yml", Config::YAML);
	$plcfg->set("Bio", "Youtuber §l§6150 subs§r§a, creator of the plugin you're currently using & other ones & Map maker");
	$plcfg->set("Status", "Creating plugin Status");
	$plcfg->set("Twitter", "§o@Ad5001P4F");
	$plcfg->set("Youtube", "§o+Ad5001 MCPE et Gaming");
	$plcfg->set("Facebook", "No facebook for now sorry");
	$plcfg->save();
    // $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  public function onJoinEvent(PlayerJoinEvent $event){
	  $player = $event->getPlayer();
	  if(!file_exists($this->getDataFolder() . "players/" . $player->getName() . ".yml")) {
	  	  $plcfg = new Config($this->getDataFolder() . $player->getName() . ".yml", Config::YAML);
		  $plcfg->set("Bio", "This player didn't set his bio for now");
	  	  $plcfg->set("Status", "This player didn't set his status for now");
	  	  $plcfg->set("Twitter", "This player didn't set his Twitter or didn't have one for now for now");
	  	  $plcfg->set("Youtube", "This player didn't set his Youtube or didn't have one for now for now");
	  	  $plcfg->set("Facebook", "This player didn't set his Facebook or didn't have one for now for now");
	  	  $plcfg->save();
	      $player->sendMessage("[Status] You've been succefully registered to Status!");
		  $this->getServer()->broadcastMessage("§l§a[Status]§r§a" . $player->getName() . " has been succefully registered to Status");
	  }
  }
  public function onLoad(){
    $this->saveDefaultConfig();
    $this->reloadConfig();
  }
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
	  $plcfg = new Config($this->getDataFolder() . "players/" . $sender->getName() . ".yml", Config::YAML);
	  $plbio = $plcfg->get("Bio");
	  $plst = $plcfg->get("Status");
	  $pltw = $plcfg->get("Twitter");
	  $plyt = $plcfg->get("Youtube");
	  $plfb = $plcfg->get("Facebook");
    switch($cmd->getName()){
		case "status":
		    if(empty($args)) {
				$sender->sendMessage("§4Usage: /status <bio | status | twitter | youtube | facebook> <message | account name>");
			} else {
				switch($args[0]) {
					case "bio":
					case "biografy":
					if(count($args) < 2) {
						$sender->sendMessage("§4Usage: /status biografy <your biografy>");
					} else {
						unset($args[0]);
						$plcfg->set("Bio", implode(" ", $args));
						$plcfg->save();
						$sender->sendMessage("§a§l[Status]§r§a You've succefully updated you're biografy to " . implode(" ", $args));
					}
		            return true;
		            break;
					case "s":
					case "status":
					if(count($args) < 2) {
						$sender->sendMessage("§4Usage: /status status <your status>");
					} else {
						unset($args[0]);
						$plcfg->set("Status", implode(" ", $args));
						$plcfg->save();
						$sender->sendMessage("§a§l[Status]§r§a You've succefully updated you're status to " . implode(" ", $args));
					}
		            return true;
		            break;
					case "t":
					case "twitter":
					if(count($args) ===! 2) {
						$sender->sendMessage("§4Usage: /status twitter <your twitter (without the @)>");
					} else {
						unset($args[0]);
						$args = str_ireplace("@", "", $args);
						$plcfg->set("Twitter", "@" . implode(" ", $args));
						$plcfg->save();
						$sender->sendMessage("§a§l[Status]§r§a You've succefully updated you're twitter to @" . implode(" ", $args));
					}
		            return true;
		            break;
					case "yt":
					case "youtube":
					if(count($args) ===! 2) {
						$sender->sendMessage("§4Usage: /status youtube <your youtube channel>");
					} else {
						unset($args[0]);
						$args = str_ireplace("+", "", $args);
						$plcfg->set("Youtube", "+" . implode(" ", $args));
						$plcfg->save();
						$sender->sendMessage("§a§l[Status]§r§a You've succefully updated you're youtube channel to +" . implode(" ", $args));
					}
		            return true;
		            break;
					case "fb":
					case "facebook":
					if(count($args) ===! 2) {
						$sender->sendMessage("§4Usage: /status facebook <your youtube channel>");
					} else {
						unset($args[0]);
						$plcfg->set("Facebook", implode(" ", $args));
						$plcfg->save();
						$sender->sendMessage("§a§l[Status]§r§a You've succefully updated you're facebook to " . implode(" ", $args));
					}
		            return true;
		            break;
					case "r":
					case "reset":
					if(count($args) ===! 2) {
						$plcfg->set("Bio", "");
						$plcfg->set("Status", "");
						$plcfg->set("Facebook", "");
						$plcfg->set("Youtube", "");
						$plcfg->set("Twitter", "");
						$plcfg->save();
						$sender->sendMessage("§a§l[Status]§r§a You've succefully reset all of your status");
					} else {
						switch($args[1]) {
							case "bio":
							case "biografy":
							$plcfg->set("Bio", "");
							$plcfg->save();
							$sender->sendMessage("§a§l[Status]§r§a You've succefully reset your Biografy");
							return true;
							break;
							case "s":
							case "status":
							$plcfg->set("Status", "");
							$plcfg->save();
							$sender->sendMessage("§a§l[Status]§r§a You've succefully reset your Status");
							return true;
							break;
							case "tw":
							case "twitter":
							$plcfg->set("Twitter", "");
							$plcfg->save();
							$sender->sendMessage("§a§l[Status]§r§a You've succefully reset your Twitter");
							return true;
							break;
							case "yt":
							case "youtube":
							$plcfg->set("Youtube", "");
							$plcfg->save();
							$sender->sendMessage("§a§l[Status]§r§a You've succefully reset your Youtube");
							return true;
							break;
							case "fb":
							case "facebook":
							$plcfg->set("Facebook", "");
							$plcfg->save();
							$sender->sendMessage("§a§l[Status]§r§a You've succefully reset your Facebook");
							return true;
							break;
							default:
							$sender->sendMessage("§4Usage: /status reset [bio | status | twitter | youtube | facebook]");
							return true;
							break;
						}
					}
		            return true;
		            break;
					default:
					return false;
					break;
				}
			}
		return true;
		break;
		case "whois":
		if(empty($args)) {
			return false;
		} elseif(file_exists($this->getDataFolder() . "players/" . $args[0] . ".yml")) {
			$player = $args[0];
			$plcfg = new Config($this->getDataFolder() . "players/" . $player . ".yml", Config::YAML);
	        $plbio = $plcfg->get("Bio");
	        $plst = $plcfg->get("Status");
	        $pltw = $plcfg->get("Twitter");
	        $plyt = $plcfg->get("Youtube");
	        $plfb = $plcfg->get("Facebook");
			if(empty($plbio)) {
				$plbio = "This player didn't set his bio for now";
			} if(empty($plst)) {
				$plst = "This player didn't set his status for now";
			} if(empty($pltw)) {
				$pltw = "This player didn't set his Twitter or didn't have one for now for now";
			} if(empty($plyt)) {
				$plyt = "This player didn't set his Youtube channel or didn't have one for now for now";
			} if(empty($plfb)) {
				$plfb = "This player didn't set his Facebook or didn't have one for now for now";
			} if($args[1] === null) {
			$sender->sendMessage("§a§l[Status]§r§6 " .$player . "'s whois:\n§2Biografy:§a " . $plbio . "\n§2Status: §a" . $plst . "\n§bTwitter: §a" . $pltw . "\n§4You§ftube: §a" . $plyt . "\n§1Facebook: §a" . $plfb);
			} else {
				switch($args[1]) {
				case "bio":
				case "biografy":
				$sender->sendMessage("§a§l[Status]§r§6 " . $player . "'s biografy:\n§a" . $plbio);
				return true;
				break;
				case "status":
				case "s":
				$sender->sendMessage("§a§l[Status]§r§6 " . $player . "'s status:\n§a" . $plst);
				return true;
				break;
				case "twitter":
				case "tw":
				$sender->sendMessage("§a§l[Status]§r§6 " .$player . "'s twitter:\n§a" . $pltw);
				return true;
				break;
				case "youtube":
				case "yt":
				$sender->sendMessage("§a§l[Status]§r§6 " .$player . "'s youtube:\n§a" . $plyt);
				return true;
				break;
				case "facebook":
				case "fb":
				$sender->sendMessage("§a§l[Status]§r§6 " .$player . "'s facebook:\n§a" . $plfb);
				return true;
				break;
				default:
				return false;
				break;
				}
			}
		} else {
			$sender->sendMessage("§4§l[Status]§r§4 This player were never seen on this server.");
		}
		return true;
		break;
    }
    return false;
  }
}
