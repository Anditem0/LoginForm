<?php
namespace BeeAZZ\LoginForm\Form;

use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use BeeAZZ\LoginForm\Main;
use jojoe77777\FormAPI\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm; 

class Formmanager{
 
  public function register(Player $player){
    $form = new CustomForm(function(Player $player, array $data = null){
    if ($data === null){
          $this->registerNoInPutPass($player);
          return false;
        }
    if($data[1] == $data[2]){
        if($data[1] == null){
            $this->registerNoInPutPass($player);
            return false;
        }
        if($data[2] == null){
            $this->registerNoInPutPass($player);
            return false;
            }
        	
        $name = $player->getName();
        Main::getInstance()->register->set($name, $data[1]);
        Main::getInstance()->register->save();
        $this->login($player);
        $this->registerNoInPutPass($player);
    }else{
     	$this->registerNoInPutPass($player);
     }
  });
  $form->setTitle("§7 đăng kí");
  $form->addLabel("§l§eHãy Nhập mật khẩu để đăng kí");
  $form->addInput("Mật Khẩu", "vui lòng nhập mật khẩu");
  $form->addInput("Nhập Mật lại Khẩu", "vui lòng nhập lại mật khẩu ");
  $form->sendToPlayer($player);
  return $form;
 }
#login lấy dữ liệu từ register 
 function login(Player $player){
    $form = new CustomForm(function(Player $player, array $data = null){
      #nếu ấn dấu x chuyển tới form.lỗi
    if($data == null){
      $this->loginNoInPutPass($player);
      return false;
    }
    #nếu input méo nhận đc gì chuyện tới form lỗi
    if($data[1]== null){
      $this->loginNoInPutPass($player);
      return false;
    }
    #check xem mật khẩu 
    $name = $player->getName();
    if($data[1] == Main::getInstance()->register->get($name))
    {
      #cho player duy chuyển
      Main::getInstance()->login->set($name, true);
      #nếu check.k đúng chuyển tới form.lỗi
      $this->successful($player);
    }else {
      $this->loginNoInPutPass($player);
    }
      });
    $form->setTitle("§7 Đăng Nhập");
    $form->addLabel("§7 Vui Lòng nhập mật khẩu để đăng nhập:");
    $form->addInput("§7Nhập Mật Khẩu", "0");
    $form->sendToPlayer($player);
              return $form;
 }
 #form đăng nhập lỗi
 public function registerNoInPutPass(Player $player){
    $form = new CustomForm(function(Player $player, array $data = null){
      if ($data === null){
        $this->registerNoInPutPass($player);
          return false;
          }
      if($data[1] == $data[2]){
        if($data[1] == null){
          $this->registerNoInPutPass($player);
            return false;
             }
        if($data[2] == null){
          $this->registerNoInPutPass($player);
             return false;
                 }
             	
        $name = $player->getName();
        Main::getInstance()->register->set($name, $data[1]);
        Main::getInstance()->register->save();
        $this->login($player);
        $this->registerNoInPutPass($player);
      }else{
        $this->registerNoInPutPass($player);
          }
  });
  $form->setTitle("§7Đăng Kí");
  $form->addLabel("§cĐăng Kí không thành công vui lòng nhập lại");
  $form->addInput("Mật Khẩu", "vui lòng nhập mật khẩu");
  $form->addInput("Nhập Mật lại Khẩu", "vui lòng nhập lại mật khẩu ");
  $form->sendToPlayer($player);
  return $form;
 } 
  #form.login lỗi
  public function loginNoInPutPass(Player $player){
    $form = new CustomForm(function(Player $player, array $data = null){
      #nếu ấn dấu x chuyển tới form.lỗi
    if($data == null){
      $this->loginNoInPutPass($player);
      return false;
    }
    #nếu input méo nhận đc gì chuyện tới form lỗi
    if($data[1]== null){
       $this->loginNoInPutPass($player);
      return false;
    }
    #check xem mật khẩu 
    $name = $player->getName();
    if($data[1] == Main::getInstance()->register->get($name))
    {
      #cho player duy chuyển
      Main::getInstance()->login->set($name, true);
      #nếu check.k đúng chuyển tới form.lỗi
      $this->successful($player);
    }else {
      $this->loginNoInPutPass($player);
    }
      });
    $form->setTitle("§7 Đăng Nhập");
    $form->addLabel("§c Đăng Nhập không thành công vui lòng nhập lại mật khẩu:");
    $form->addInput("§7Nhập Mật Khẩu", "0");
    $form->sendToPlayer($player);
              return $form;
 }
  public function successful(Player $player){
	  $form = new SimpleForm(function (Player $sender, ?int $data = null){
      if($data === null){
          return true;
          }
      });
    $form->setTitle("§e§l【§c ＴＨＥ §0ＶＯＩＤ §e】"); 
    $form->setContent("§a Chào mừng đã đã đến với server chúng tôi. chúng tôi lun muốn bạn có 1 trãi nhiệm tốt nhất khi chơi game, vì vậy chúng tôi có 1 số luật để mọi người chấp để có 1 server Minecraft văn minh , lịch sự:\n\n§2Ｌuật:\n§a+§r không sử dụng các phần mền thứ 3 để can thiệp vào game, nếu bị staff của server bắt được sẽ bị ban vĩnh viễn.\n§a+§r Không quảng cáo server hoặc tất cả các đường link web hoặc fb , Không có những hành vi gây rối chửi bới làm mất trật tự và văn mịnh của server.\n§a+§r Không được lợi dụng bug (lỗi) đẻ trục lợi, nếu có bug (lỗi) hãy báo ngay cho admin hoặc ban quản trị của server để có hướng giải quyết để mọi người có khoản thời gian chơi game tốt nhấ.\nChúc các bạn 1 ngày tốt lành ");
    $form->addButton("Đã Hiểu");
    $player->sendForm($form);
  }
  
}
 
 
