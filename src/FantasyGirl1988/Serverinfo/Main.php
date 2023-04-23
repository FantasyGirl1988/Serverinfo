<?php

namespace FantasyGirl1988\Serverinfo;

use pocketmine\permission\Permission;

use pocketmine\permission\PermissionManager;

use pocketmine\scheduler\TaskScheduler;

use pocketmine\player\GameMode;

use onebone\economyapi\EconomyAPI;

use pocketmine\Server;

use pocketmine\network\mcpe\protocol\TransferPacket;

use jojoe77777\FormAPI\SimpleForm;

use libpmquery\PMQuery;

use libpmquery\PmQueryException;

use pocketmine\player\Player;

use pocketmine\command\CommandMap;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

  

  public function onEnable(): void{

    $this->getLogger()->info("Geladen!");

  }

  

  public function onDisable(): void{

    $this->getLogger()->info("entladen!");

  }

  

  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{

    switch($cmd->getName()){

      

      case "servers":

        if(!$sender instanceof Player){

          $sender->sendMessage("Du bist kein Spieler!");

          return false;

        }

        $this->server($sender);

        break;

    }

    return true;

  }

  

  public function server(Player $player){

    $server = new SimpleForm(function(Player $player, $data = null){

      if($data === null){

        return true;

      }

      

      switch($data){

        case 0:

          $this->cb($player);

          break;

        case 1:

          $this->baus($player);

          break;

        case 2:

          break;

      }

    });

    $server->setTitle("§aServer");

    $server->setContent("§7Willkommen in Server Menu!");

    $server->addButton("§aCityBuild");

    $server->addButton("§aLobby");

    $server->addButton("§aBau Server");

    $server->sendToPlayer($player);

    return $server;

  }

  

  public function cb(Player $player){

    $cb = new SimpleForm(function(Player $player, $data = null){

      if($data === null){

        return true;

      }

      

      switch($data){

        

        case 0:

          $address = "45.142.115.133";

          $port = 19135;

          $packet = new TransferPacket();

          $packet->address = $address;

          $packet->port = $port;

          $player->getNetworkSession()->sendDataPacket($packet);

          $player->sendMessage("§aVerbinde zum Server CityBuild");

          break;

      }

    });

    $cb->setTitle("§aCityBuild");

    try{

      $query = PMQuery::query("45.142.115.133", 19135);

      $players = $query['Players'];

      $maxplayers = $query['MaxPlayers'];

      $version = $query['Version'];

      $protocol = $query['Protocol'];

      $cb->setContent("§7Server Status: §aOnline\n§7Version: §a" . $version . "\n§7Protokol: §a" . $protocol . "\n§7Online: §a" . $players . "§8/§7" . $maxplayers);

    }catch(PmQueryException $e){

      $query = PMQuery::query("44.142.115.133", 19135);

      $players = $query['Players'];

      $maxplayers = $query['MaxPlayers'];

      $version = $query['Version'];

      $protocol = $query['Protocol'];

      $player->sendMessage("§cDer Server ist §4Offline");

      $cb->setContent("§7Status: §4OFFLINE\n§7Online: §a0/0");

    }

    $cb->addButton("§aBetreten");

    $cb->sendToPlayer($player);

    return $cb;

  }

  

  public function bau(Player $player){

    $bau = new SimpleForm(function(Player $player, $data = null){

      if($data === null){

        return true;

      }

      

      switch($data){

        

        case 0:

          $address = "45.142.115.133";

          $port = 19136;

          $packet = new TransferPacket();

          $packet->address = $address;

          $packet->port = $port;

          $player->getNetworkSession()->sendDataPacket($packet);

          $player->sendMessage("§aVerbinde zum Server Bau Server");

          break;

      }

    });

    $bau->setTitle("§aBau Server");

    try{

      $query = PMQuery::query("45.142.115.133", 19136);

      $players = $query['Players'];

      $maxplayers = $query['MaxPlayers'];

      $version = $query['Version'];

      $protocol = $query['Protocol'];

      $bau->setContent("§7Server Status: §aOnline\n§7Version: §a" . $version . "\n§7Protokol: §a" . $protocol . "\n§7Online: §a" . $players . "§8/§7" . $maxplayers);

    }catch(PmQueryException $e){

      $player->sendMessage

      $bau->setContent("§7Status: §4OFFLINE\n§7Online: §a0/0");

    }

    $bau->addButton("§aBetreten");

    $bau->sendToPlayer($player);

    return $cb;

  }

  

  public function lobby(Player $player){

    $lobby = new SimpleForm(function(Player $player, $data = null){

      if($data === null){

        return true;

      }

      

      switch($data){

        

        case 0:

          $address = "45.142.115.133";

          $port = 19134;

          $packet = new TransferPacket();

          $packet->address = $address;

          $packet->port = $port;

          $player->getNetworkSession()->sendDataPacket($packet);

          $player->sendMessage("§aVerbinde zum Server Lobby");

          break;

      }

    });

    $lobby->setTitle("§aLobby");

    try{

      $query = PMQuery::query("45.142.115.133", 19134);

      $players = $query['Players'];

      $maxplayers = $query['MaxPlayers'];

      $version = $query['Version'];

      $protocol = $query['Protocol'];

      $lobby->setContent("§7Server Status: §aOnline\n§7Version: §a" . $version . "\n§7Protokol: §a" . $protocol . "\n§7Online: §a" . $players . "§8/§7" . $maxplayers);

    }catch(PmQueryException $e){

      $lobby->setContent("§7Status: §4OFFLINE\n§7Online: §a0/0");

    }

    $lobby->addButton("§aBetreten");

    $lobby->sendToPlayer($player);

    return $lobby;

  }

}
