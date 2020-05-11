<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $player = new Player();
        $this->assertInstanceOf("\Lefty\Dice\Player", $player);
        
        $hand = $player->getPlayerHand();
        $this->assertInstanceOf("\Lefty\Dice\DiceHand", $hand);
    }

    /**
     * Construct dices, roll and check expected number of values
     */
    public function testCreateWithArgumentName()
    {
        $player = new Player("Jane Doe", 1, false);
        $res = $player->getName();
        $exp = "Jane Doe";

        $this->assertEquals($exp, $res);
    }
    /**
     * Test creating and getting player hand
     */
    public function testPlayerHandCreationAndReset()
    {
        $player = new Player();
        
        $hand1 = $player->getPlayerHand();

        $player->clearPlayerHand();
        $hand2 = $player->getPlayerHand();

        $this->assertNotSame($hand1, $hand2);
    }
    /**
     * Test creating and getting player hand
     */
    public function testPlayerHandCreationAndReset2()
    {
        $player = new Player();
        
        $hand1 = $player->getPlayerHand();


        $hand2 = $player->getPlayerHand();

        $this->assertSame($hand1, $hand2);
    }
    /**
     * Test computer play
     */

    public function testComputerPLay()
    {
        $cpu = new Player("cpu", 1, true);

        $res = $cpu->isComputer();
        
        $this->assertTrue($res);

        $res = $cpu->makePlay(95, 9, 100)[0];
        $this->assertEquals("save", $res);

        $res = $cpu->makePlay(25, 1, 100)[0];
        $this->assertEquals("save", $res);

        $res = $cpu->makePlay(0, 10, 100)[0];
        $this->assertEquals("save", $res);

        $res = $cpu->makePlay(23, 1, 100)[0];
        $this->assertEquals("roll", $res);
    }
}
