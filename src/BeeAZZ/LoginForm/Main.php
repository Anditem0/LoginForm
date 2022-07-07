<?php
namespace BeeAZZ\LoginForm;
use pocketmine\Server;
use pocketmine\Player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;
use BeeAZZ\LoginForm\Form\FormManager;
use BeeAZZ\LoginForm\Task\KickTask;

class Main extends PluginBase implements Listener {
  
  public $register;
  
  public $login;
  
  public function onEnable():void{
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->login = new Config($this->getDataFolder()."login.yml",Config::YAML);
    $this->register = new Config($this->getDataFolder()."register.yml",Config::YAML);
     $this->saveDefaultConfig();
  }
  private static $instance = null;
  
	public function onLoad() :void{
        self::$instance = $this;
	}
	
	public static function getInstance(): self{
        return self::$instance;
    }
  public function onJoin(PlayerJoinEvent $ev){
    $form = new FormManager();
    $player = $ev->getPlayer();
    $name = $player->getName();
    $this->getScheduler()->scheduleDelayedTask(new KickTask($this, $name), 20 * 150);
    if(!$this->register->exists($name)){
      $form->register($player);
    }else {
      $form->login($player);
    }   
  }
  public function onQuit(PlayerQuitEvent $ev){
   $player = $ev->getPlayer();
   $name = $player->getName();
   $this->login->set($name, false);
   $this->login->save();
  }
  
}
