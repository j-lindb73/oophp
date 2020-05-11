<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceRoundTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $player = new Player();
        $diceRound = new DiceRound($player);
        $this->assertInstanceOf("\Lefty\Dice\DiceRound", $diceRound);
    }

    /**
     * Construct round with argument
     */
    public function testCreateObjectWithArguments()
    {
        $player = new Player();
        $diceRound = new DiceRound($player, 10);

        $res = $diceRound->getRoundScore();
        $exp = 10;
        $this->assertEquals($exp, $res);
    }

        /**
     * Construct round with argument and set score
     */
    public function testRoundSetScore()
    {
        $player = new Player();
        $diceRound = new DiceRound($player, 10);

        $diceRound->setRoundScore(10);
        $res = $diceRound->getRoundScore();
        $exp = 20;
        $this->assertEquals($exp, $res);
    }

            /**
     * Construct round with argument and set score
     */
    public function testRoundResetScore()
    {
        $player = new Player();
        $diceRound = new DiceRound($player, 10);

        $diceRound->zeroRoundScore();
        $res = $diceRound->getRoundScore();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
