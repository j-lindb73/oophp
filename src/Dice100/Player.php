<?php

namespace Lefty\Dice;

class Player
{
    private $score;
    private $roundScore;
    private $hand;

    public function _construct(int $dices=5)
    {
        $this->score = 0;
        $this->roundScore = 0;
        $this->hand = new DiceHand($dices);
        $this->hand->roll;
    }

    public function score()
    {
        return $this->score;
    }

}
