<?php

namespace Lefty\Dice100;

class Game
{
    public $player;
    public $cpu;

    public function _construct($dices = 5)
    {
        $this->player = new Player($dices);
        $this->cpu = new Player($dices);
    }

    public function player() : Player
    {
        return $this->player;
    }

}
