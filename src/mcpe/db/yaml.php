<?php
namespace mcpe\db;

use pocketmine\utils\Config;

class yaml
{

    private $plugin;

    public function __construct($plugin){
        $this->plugin = $plugin;
    }

    public function createData($player){
        $db = new Config($this->plugin->getDataFolder() ."/timer.yml", Config::YAML);
        if($db->exists($player->getName())){
            $arr = [$player->getName() => 0];
            $db->setAll($arr);
            $db->save();
        }
    }

    public function addTimer($player, $time){
        $db = new Config($this->plugin->getDataFolder() ."/timer.yml", Config::YAML);
        $arr = [$player->getName() => $this->getTimer($player) + $time];
        $db->setAll($arr);
        $db->save();
    }

    public function getTimer($player): int{
        $db = new Config($this->plugin->getDataFolder() ."/timer.yml", Config::YAML);
        return $db->get($player->getName());
    }

    public function resetTimer($player){
        $db = new Config($this->plugin->getDataFolder() ."/timer.yml", Config::YAML);
        $arr = [$player->getName() => 0];
        $db->setAll($arr);
        $db->save();
    }

    public function reducetime($player){
        $db = new Config($this->plugin->getDataFolder() ."/timer.yml", Config::YAML);
        $arr = [$player->getName() => $this->getTimer($player) - 1];
        $db->setAll($arr);
        $db->save();
    }
}