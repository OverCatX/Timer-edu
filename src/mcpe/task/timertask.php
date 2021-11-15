<?php

namespace mcpe\task;

use mcpe\db\yaml;

class timertask extends \pocketmine\scheduler\Task
{

    private $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(int $i)
    {
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
            $db = new yaml($this->plugin);
            if($db->getTimer($player) <= 0){ //check timer ว่า <= 0 หรือไม่
                $db->resetTimer($player); //if (int) timer <=0 จะ set timer = 0;
            } else {
                $db->reducetime($player); //reduce time every ticks til time <= 0 จะวนขึ้นไปหาเงื่อนไชเดิม
            }
        }

    }
}