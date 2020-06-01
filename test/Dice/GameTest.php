<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GameTest extends TestCase
{
    private $game;

    /**
    * Setup the game for testing.
    */
    protected function setUp(): void
    {

        // Create and initiate the game.

        $this->game = new Game();
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
 

        $this->assertInstanceOf("\Lefty\Dice\Game", $this->game);
    }

    /**
     * Construct round with argument
     */
    public function testCreateRound()
    {
 
        $this->game->newRound();
        $diceRound = $this->game->getCurrentRound();

        $this->assertInstanceOf("\Lefty\Dice\DiceRound", $diceRound);
    }

    /**
     * Test bad throw false
     */
    public function testBadThrowFalse()
    {

      
        $res = $this->game->badThrow();

        $this->assertFalse($res);
    }
    /**
     * Test bad throw true
     */
    public function testBadThrowTrue()
    {
 
        $this->game->roll();
      
        $res = $this->game->badThrow();

        $this->assertTrue($res);
    }

        /**
     * Check winner
     */
    public function testWinnerTrue()
    {

        $this->game->player->setScore(101);

        $res = $this->game->checkWinner();
        $winner = $this->game->getWinner();

        $this->assertTrue($res);
        $this->assertInstanceOf("\Lefty\Dice\Player", $winner);
    }

            /**
     * Check no winner
     */
    public function testWinnerFalse()
    {

        $this->game->player->setScore(99);

        $res = $this->game->checkWinner();


        $this->assertFalse($res);
    }
}
