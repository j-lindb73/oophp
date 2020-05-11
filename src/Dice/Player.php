<?php

/**
 * A class for Player in game Dice100
 */

namespace Lefty\Dice;

class Player
{
        /**
     * @var int $score          Player score
     * @var int $dices          Number of dices to play with
     * @var object DiceHand()   Hand of dices
     * @var string $name        Player name
     * @var boolean $isComputer Is player human or cpu?
     */

    private $score;
    private $dices;
    private $hand;
    private $name;
    private $isComputer;

    /**
     * Initiate player
     *
     * @param string $name          Player name
     * @param int $dices            Number of dices to play with
     * @param boolean $isComputer   Is player human or cpu?
     */
    public function __construct(string $name = "John Doe", int $dices = 5, $isComputer = false)
    {
        $this->score = 0;
        $this->dices = $dices;
        $this->hand = new DiceHand($dices);
        $this->name = $name;
        $this->isComputer = $isComputer;
    }



    /**
    * Return player score
    *
    * @return int Player score
    */
    public function getScore()
    {
        return $this->score;
    }



    /**
    * Set player score
    *
    * @param int Player score
    * @return void
    */
    public function setScore($add)
    {
        $this->score += $add;
    }




    /**
    * Get player name
    *
    * @return string Player name
    */
    public function getName()
    {
        return $this->name;
    }



    /**
    * Get player hand
    *
    * @return object Player hand
    */
    public function getPlayerHand()
    {
        return $this->hand;
    }




    /**
    * Clear player hand
    *
    * @return void
    */
    public function clearPlayerHand()
    {
        $this->hand = new DiceHand($this->dices);
    }




    /**
    * Roll dices in player hand
    *
    * @return void
    */
    public function roll()
    {
        $this->hand->roll();
    }



    /**
    * Is player human or computer?
    *
    * @return boolean isComputer
    */
    public function isComputer()
    {
        return $this->isComputer;
    }




    /** Computer Logic
    *  If ScoreToWin = 100
    *  Total score >=100   : save
    *  Total score >=90    : roll
    *  Round score >=20    : save
    *  Roll score  >=10    : save
    *
    *  @param int $roundScore  Round score
    *  @param int $rollScore   Roll score
    *  @param int $scoreToWin  Score to win game
    */
    public function makePlay($roundScore, $rollScore, $scoreToWin)
    {
        if ($this->score + $roundScore + $rollScore >= $scoreToWin) {
            return ["save", "Datorn sparar"];
        // } elseif (($this->score + $roundScore) >= ($scoreToWin - $scoreToWin/10)) {
        } elseif (($this->score + $roundScore) >= (100 - 10)) {
            return ["roll", "Datorn kastar"];
        } elseif ($roundScore >= $scoreToWin/4) {
            return ["save", "Datorn sparar"];
        } elseif ($rollScore >=10) {
            return ["save", "Bra kast! Datorn sparar"];
        } else {
            return ["roll", "Datorn kastar"];
        }
    }
}
