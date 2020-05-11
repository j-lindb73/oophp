<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Lefty\Dice\DiceHand", $diceHand);
    }

    /**
     * Construct dices, roll and check expected number of values
     */
    public function testCreateWithArgument()
    {
        $diceHand = new DiceHand(3);
        $diceHand->roll();
        $res = count($diceHand->values());
        $exp = 3;

        $this->assertEquals($exp, $res);
    }

    /**
     * Construct dices, roll and get sum, calculate and check average
     */
    public function testSumAndAverage()
    {
        $diceHand = new DiceHand(3);
        $diceHand->roll();
        $dices = count($diceHand->values());
        $sum = $diceHand->getSum();
        $res = $sum / $dices;
        $average = $diceHand->average();

        $this->assertEquals($average, $res);
    }
    /**
     * Construct dices and check graphic
     */
    public function testDiceGraphic()
    {
        $diceHand = new DiceHand(1);
        $diceHand->roll();
        $res = $diceHand->values()[0];
        $exp = substr($diceHand->getGraphics()[0], 5);

        $this->assertEquals($exp, $res);
    }
}
