<?php

namespace BeeAZZ\LoginForm\Task;

use pocketmine\scheduler\Task;
use BeeAZZ\LoginForm\Main;

class KickTask extends Task{
  
  public $plugin;
  
  public $name;
  
  public function __construct(Main $plugin, $name){
   $this->plugin = $plugin;
   $this->name = $name;
  }
  
  public function onRun(): void{
   if($this->plugin->getServer()->getPlayerByPrefix($this->name) !== null){
     $player = $this->plugin->getServer()->getPlayerByPrefix($this->name);
   if($this->plugin->login->get($this->name) !== true){
     $player->kick("§l§c Bạn đc hết giời gian đăng nhập");
     }
   }
 }
} 
