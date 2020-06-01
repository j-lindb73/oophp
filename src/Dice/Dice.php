<?php

namespace Lefty\Dice;

/**
 * Class for dice
 */

class Dice
{
    /**
     *
     * @var int $sides    Number of sides of dice
     * @var int $value    Last roll
     */
    protected $sides;
    private $number;



   /**
     * Constructor to create a Dice
     *
     * @param int    $sides   Number of sides the dice has, defaults to 6
     */

    public function __construct($sides = 6)
    {
        $this->sides = $sides;
        // $this->roll();
    }




    /**
     * Roll dice and return number
     *
     * @return int Value after roll
     */
    public function roll()
    {
        $this->number = rand(1, $this->sides);
        // return $this->number;
        return $this->getLastNumber();
    }



    /**
     * Return dice number
     *
     * @return int Dice value
     */
    public function getlastNumber()
    {
        return $this->number;
    }
}
