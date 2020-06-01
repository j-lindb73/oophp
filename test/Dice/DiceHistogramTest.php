<?php

namespace Lefty\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHistogramTest extends TestCase
{
    
    private $histogram;
    private $hand;

        /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {

        // Create and initiate the histogram.
        // 100 dices is constructed which will guarantee min and max values (1 and 6)
        $this->histogram = new DiceHistogram();
        $this->hand = new DiceHand(100);
        $this->hand->roll();
        $this->histogram->injectData($this->hand);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testPrintHistogram()
    {

        $res = $this->histogram->printHistogram();

        $this->assertIsString($res);
    }

    /**
    * Compare number of values to number of dices
    */
    public function testSizeSerie()
    {

        $res = count($this->histogram->getHistogramSerie());
        $exp = 100;
        $this->assertEquals($exp, $res);
    }

    /**
    * Check min value in serie
    */
    public function testSerieMin()
    {

        $res = ($this->histogram->getHistogramMin());
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
    * Check max value in serie
    */
    public function testSerieMax()
    {

        $res = ($this->histogram->getHistogramMax());
        $exp = 6;
        $this->assertEquals($exp, $res);
    }
}
