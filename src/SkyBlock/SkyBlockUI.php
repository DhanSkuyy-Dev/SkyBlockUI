<?php

namespace SkyBlock;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\math\Vector3;
use pocketmine\level\Position;

use pocketmine\level\Level;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\Config;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;


class SkyBlockUI extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info(C::GREEN . "[Enabled] SkyBlockUI By DhanSkuyy");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);      
        
        @mkdir($this->getDataFolder());
	$this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onLoad(){
        $this->getLogger()->info(C::YELLOW . "[Loading] SkyBlockUI");
    }

    public function onDisable(){
        $this->getLogger()->info(C::RED . "[Disable] Plugin Error Suh Butuh FormAPI");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "sbui":
                if($sender instanceof Player){
                    $this->KontolAsu($sender);
                }else{
                    $sender->sendMessage("§cGunakan Command Dalam Game Kontol!");
                } 
                break;
        }
        return true;
    }
        

	public function KontolAsu($sender){

      	$form = new SimpleForm(function (Player $sender, $data){

            $result = $data;

            if ($result == null) {

            }

            switch ($result) {

				case 0:

			         

				break;
				
				case 1:
				    
				    $this->getServer()->getCommandMap()->dispatch($sender, "is create");
				    $sender->sendMessage($this->cfg->get("msg-create"));
				
				break;
				
                case 2:
    
                     $this->getServer()->getCommandMap()->dispatch($sender, "is join");
                     $sender->sendMessage($this->cfg->get("msg-tp-home"));
                     $sender->addTitle($this->cfg->get("title-tp"));
                break;
                
                case 3:
                    
                     $this->getServer()->getCommandMap()->dispatch($sender, "is leave");
                
                break;
                
                case 4: 
                    
                    $this->getServer()->getCommandMap()->dispatch($sender, "is lock");
                    
                break;
                
                case 5:
                
                     $this->visitIsland($sender);
                     
                break;
                
                case 6:
                
                     $this->addFriend($sender);
                
                break;
                
                case 7:
                    
                     $this->getServer()->getCommandMap()->dispatch($sender, "is disband");
                     
                break;
                
           
			}

		});

	   $form->setTitle($this->cfg->get("title-ui"));
	   
	   $form->setContent($this->cfg->get("content-ui"));
	   
	   $form->addButton("§cClose\n§0§oTap To Close", 0, "textures/blocks/barrier");
	   
	   $form->addButton("§aCreate Island\n§0§oTap To Create", 0, "textures/ui/icon_recipe_nature");
	   
	   $form->addButton("§aIsland Home\n§0§oTap To Island Home", 0, "textures/ui/icon_recipe_item");
	   
	   $form->addButton("§aIsland Leave\n§0§oTap To Leave Island", 0, "textures/ui/dressing_room_capes");
	   
	   $form->addButton("§aIsland Lock\n§0§oTap To Lock Island", 0, "textures/ui/lock_color");
	   
	   $form->addButton("§aVisit Island\n§0§oTap To Visit Island", 0, "textures/ui/magnifyingGlass");
	   
	   $form->addButton("§aInvite Friend\n§0§oTap To Invite Friend", 0, "textures/ui/icon_multiplayer");
	   
	   $form->addButton("§aDisband Island\n§0§oTap To Disband Island", 0, "textures/ui/trash");
	   
	   $form->sendToPlayer($sender);

	   return true;

	}
	
	public function visitIsland($sender){

      	$form = new CustomForm(function (Player $sender, $data){

            if($data !== null){
				
			    $this->getServer()->getCommandMap()->dispatch($sender, "is visit $data[0]");
		
				}

		});

		$form->setTitle("§l§aVisit Island");

        $form->addInput("Player Name");
        
		$form->sendToPlayer($sender);
		
		}
		
		public function addFriend($sender){

      	$form = new CustomForm(function (Player $sender, $data){

            if($data !== null){
            	
				$this->getServer()->getCommandMap()->dispatch($sender, "is invite $data[0]");
				
				}

		});

		$form->setTitle("§l§aInvite Friend");

        $form->addInput("Player Name");
        
		$form->sendToPlayer($sender);
		return true;

		

	}
}
