<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new Game();

        $this->assertInstanceOf("\Lefty\Dice\Game", $game);
    }

    /**
     * Construct round with argument
     */
    public function testCreateRound()
    {
        $game = new Game();
        $game->newRound();
        $diceRound = $game->getCurrentRound();

        $this->assertInstanceOf("\Lefty\Dice\DiceRound", $diceRound);
    }

    /**
     * Test bad throw false
     */
    public function testBadThrowFalse()
    {
        $game = new Game(100);
      
        $res = $game->badThrow();

        $this->assertFalse($res);
    }
    /**
     * Test bad throw true
     */
    public function testBadThrowTrue()
    {
        $game = new Game(100);

        $game->roll();
      
        $res = $game->badThrow();

        $this->assertTrue($res);
    }
}
