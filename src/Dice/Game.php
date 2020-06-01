<?php

/**
 * A class controlling gameplay in Dice100
 */

namespace Lefty\Dice;

class Game
{
    /**
     * @var object $player          Human player
     * @var object $cpu             Computer player
     * @var object $currentPlayer   Current player
     * @var int @scoreToWin         Score to win game
     * @var object $winner          The winner
     */
    public $player;
    public $cpu;
    private $currentPlayer;
    private $currentRound;
    private $scoreToWin = 100;
    private $winner;
    private $histogram;


    /**
     * Initiate game
     *
     * @param int $dices    Number of dices
     */
    public function __construct(int $dices = 5)
    {
        $this->player = new Player("Du", $dices);
        $this->cpu = new Player("Datorn", $dices, true);
        $this->currentPlayer = $this->player;
        $this->currentRound = new DiceRound($this->currentPlayer);

        $this->histogram = new DiceHistogram();
        $this->histogram->injectData($this->currentPlayer->getPlayerHand());
    }

    /**
     * Get current player
     *
     * @return object Player()
     */
    public function getCurrentPlayer() : Player
    {

        return $this->currentPlayer;
    }

    /**
     * Change player
     *
     * @return object Player()
     */
    public function setNextPlayer() : Player
    {
        $this->currentPlayer = $this->currentPlayer == $this->player ? $this->cpu : $this->player;
        return $this->getCurrentPlayer();
    }

    /**
     * Get current round
     *
     * @return DiceRound
     */

    public function getCurrentRound()
    {
        return $this->currentRound;
    }

    /**
    * Create new round
    *
    * @return void
    */

    public function newRound()
    {
        $this->currentRound = new DiceRound($this->currentPlayer);
    }

    /**
     * Roll dice and update sum for round depending on if it's a bad throw or not
     *
     * @return void
     */
    public function roll()
    {
        $this->currentPlayer->roll();

        $rollScore = $this->getCurrentPlayer()->getPlayerHand()->getSum();
        if ($this->badThrow()==true) {
            $this->currentRound->zeroRoundScore();
        } else {
            $this->currentRound->setRoundScore($rollScore);
        }
        $this->histogram->injectData($this->currentPlayer->getPlayerHand());
    }

    /**
     * Check dices for a 1.
     *
     * @return boolean
     */
    public function badThrow()
    {
        return in_array(1, $this->currentPlayer->getPlayerHand()->values());
    }

    /**
     * Unset player hands, set the next player and create a new round
     *
     * @return void
     */

    public function goToNextRound()
    {
        $this->currentPlayer->clearPlayerHand();
        $this->setNextPlayer();
        $this->newRound();
    }

    /**
     * Get round score and add it to current player
     *
     * @return void
     */
    public function save()
    {
        $sumToAdd = $this->currentRound->getRoundScore();
        $this->currentPlayer->setScore($sumToAdd);
    }
    
    /** Check if current player has won
     *
     * @return boolean
     */

    public function checkWinner()
    {
        if ($this->currentPlayer->getScore() >= $this->scoreToWin) {
            $this->winner = $this->getCurrentPlayer();
            return true;
        }
        return false;
    }

    /**
     * Return game winner
     *
     * @return object Player
     */

    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Return score to win game
     *
     * @return int
     */

    public function scoreToWin()
    {
        return $this->scoreToWin;
    }

       /**
     * Get histogram
     *
     * @return Histogram
     */

    public function getHistogram()
    {
        return $this->histogram;
    }
}
