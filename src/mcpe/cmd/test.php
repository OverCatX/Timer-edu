<?php

namespace mcpe\cmd;

use mcpe\db\yaml;
use mcpe\msg\convert;
use mcpe\timer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class test extends Command implements PluginIdentifiableCommand
{

    private $plugin;

    public function __construct(timer $plugin)
    {
        parent::__construct("test", "test...");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            $player = $sender->getPlayer();
            $db = new yaml($this->plugin);
            if($db->getTimer($player) <= 0){ //if else ตรงเวลา put ใส่เอง ค่า int
                $db->addTimer($player,100); //you can change this time to double or float
                $player->sendMessage("added time 100 secs");
            } else { //timeleft
                $time = explode(":",convert::convertTime($db->getTimer($player)));
                $hours = floor($time[0]); // เหตุที่ใช้ function floor เพราะจะได้ค่า integer นิ่งๆ
                $minutes = floor($time[1]);// เหตุที่ใช้ function floor เพราะจะได้ค่า integer นิ่งๆ
                $seconds = floor($time[2]);// เหตุที่ใช้ function floor เพราะจะได้ค่า integer นิ่งๆ
                $player->sendMessage("time left: ".$hours." hours ".$minutes." minutes ".$seconds." seconds");
            }

        }
    }

    public function getPlugin(): Plugin
    {
        return $this->plugin;
    }
}