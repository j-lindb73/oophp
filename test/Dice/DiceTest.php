<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    /**
     * Test creation of dice
     */
    public function testCreateDice()
    {
        $dice = new Dice(1);
        $dice->roll();

        $res = $dice->getlastNumber();

        $exp = 1;
        $this->assertEquals($exp, $res);
    }
}
