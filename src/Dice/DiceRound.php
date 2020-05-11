<?php

namespace Lefty\Dice;

/**
 * A round of play.
 */
class DiceRound
{
    /**
    * @var Player              Current player
    * @var int  $roundScore    Score in round
    */
    private $currentPlayer;
    private $roundScore;

    /**
     * Constructor to initiate the active player and round score
     *
     * @param object Player()   Current player object
     * @param int $roundScore   Round score, defaults to 0
     */
    public function __construct($currentPlayer, $roundScore = 0)
    {
        $this->currentPlayer = $currentPlayer;
        $this->roundScore = $roundScore;
    }



    /**
     * Return the round score.
     *
     * @return int Round score
     */
    public function getRoundScore()
    {
        return $this->roundScore;
    }



    /**
     * Update round score
     *
     * @param int Sum of roll
     * @return void.
     */
    public function setRoundScore(int $rollSum = 0)
    {
        $this->roundScore += $rollSum;
    }



    
    /**
     * Clear round score
     *
     * @return void.
     */
    public function zeroRoundScore()
    {
        $this->roundScore = 0;
    }
}
