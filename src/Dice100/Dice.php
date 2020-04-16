<?php

namespace Lefty\Dice;

class Dice
{

    public $sides;
    private $number;

    public function __construct($sides = 6) {
        $this->sides = $sides;
        // $this->roll();
    }

    public function roll() {
        $this->number = rand(1, $this->sides);
        return $this->number;
    }

    public function getlastNumber() {
        return $this->number;
    }

}
