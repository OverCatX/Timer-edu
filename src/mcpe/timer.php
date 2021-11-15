<?php
namespace mcpe;

use mcpe\cmd\test;
use mcpe\event\join;
use mcpe\task\timertask;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class timer extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->regEvent();
        $this->regCmd();
        $this->regTask(1); // 1 = ticks
    }

    private function regEvent(){
        $this->getServer()->getPluginManager()->registerEvents(new join($this), $this);
    }

    private function regTask(int $time){
        $this->getScheduler()->scheduleRepeatingTask(new timertask($this), 20*$time);
    }
    private function regCmd(){
        $this->getServer()->getCommandMap()->register("test", new test($this));
    }
}

