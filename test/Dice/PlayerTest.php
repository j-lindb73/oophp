<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class PlayerTest extends TestCase
{
    private $player;

    /**
    * Setup the player for testing.
    */
    protected function setUp(): void
    {

        // Create and initiate the game.

        $this->player = new Player("Jane Doe", 1, false);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {

        $this->assertInstanceOf("\Lefty\Dice\Player", $this->player);
        
        $hand = $this->player->getPlayerHand();
        $this->assertInstanceOf("\Lefty\Dice\DiceHand", $hand);
    }

    /**
     * Construct dices, roll and check expected number of values
     */
    public function testCreateWithArgumentName()
    {
        // $player = new Player("Jane Doe", 1, false);
        $res = $this->player->getName();
        $exp = "Jane Doe";

        $this->assertEquals($exp, $res);
    }
    /**
     * Test creating and getting player hand
     */
    public function testPlayerHandCreationAndReset()
    {
        // $player = new Player();
        
        $hand1 = $this->player->getPlayerHand();

        $this->player->clearPlayerHand();
        $hand2 = $this->player->getPlayerHand();

        $this->assertNotSame($hand1, $hand2);
    }
    /**
     * Test creating and getting player hand
     */
    public function testPlayerHandCreationAndReset2()
    {
        // $player = new Player();
        
        $hand1 = $this->player->getPlayerHand();


        $hand2 = $this->player->getPlayerHand();

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

        $res = $cpu->makePlay(95, 9, 0)[0];
        $this->assertEquals("save", $res);

        $res = $cpu->makePlay(89, 1)[0];
        $this->assertEquals("roll", $res);

        $res = $cpu->makePlay(0, 25, 1)[0];
        $this->assertEquals("save", $res);

        $res = $cpu->makePlay(0, 0, 10)[0];
        $this->assertEquals("save", $res);

        $res = $cpu->makePlay(0, 23, 1)[0];
        $this->assertEquals("roll", $res);
        $this->assertIsString($res);

        $res = $cpu->makePlay(0, 23, 1);
        $this->assertIsArray($res);
    }
}
