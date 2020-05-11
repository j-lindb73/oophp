<?php

namespace Lefty\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
    * @var Dice $dices   Array consisting of dices.
    * @var int  $values  Array consisting of last roll of the dices.
    */
    private $dices;
    private $values;
    private $graphic;



    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices  = [];
        $this->values = [];
        $this->graphic = [];

        for ($i = 0; $i < $dices; $i++) {
            // $this->dices[]  = new Dice();
            $this->dices[]  = new DiceGraphic();
            // $this->values[] = null;
        }
    }


    

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $noOfDices = count($this->dices);
        for ($key = 0; $key < $noOfDices; $key++) {
            $this->values[$key] = $this->dices[$key]->roll();
            $this->graphic[$key] = $this->dices[$key]->graphic();
        }


        // foreach ($this->dices as $key => $value) {
        //     $this->values[$key] = $this->dices[$key]->roll();
        //     $this->graphic[$key] = $this->dices[$key]->graphic();
        //     $notUsed = $value;
        // }
    }



    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    public function getGraphics()
    {
        return $this->graphic;
    }



    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function getSum()
    {
        return array_sum($this->values);
    }



    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        return $this->getSum() / count($this->values);
    }
}
