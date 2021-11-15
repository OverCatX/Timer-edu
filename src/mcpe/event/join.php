<?php

namespace mcpe\event;

use mcpe\db\yaml;
use pocketmine\event\player\PlayerJoinEvent;

class join implements \pocketmine\event\Listener
{

    private $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }

    public function join(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $db = new yaml($this->plugin);
        $db->createData($player);
    }

}