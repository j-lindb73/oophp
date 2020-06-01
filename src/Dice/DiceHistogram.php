<?php

namespace Lefty\Dice;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram extends Dice implements HistogramInterface
{
    use HistogramTrait;

    private $serie = [];

    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    // public function getHistogramMax()
    // {
    //     return $this->sides;
    // }

    /**
     * Inject the object to  use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $newRoll = $object->getHistogramSerie();

        $this->serie = array_merge($this->serie, $newRoll);

        // $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }

        /**
     * Print out the histogram
     *
     * @return string representing the histogram.
     */
   
    
    public function printHistogram()
    {
        $histArr = array_count_values($this->serie);
        // ksort($histArr);
        $html = "";
        
        for ($i = $this->min; $i <= $this->max; $i++) {
            if (array_key_exists($i, $histArr)) {
                $stars = str_repeat("*", $histArr[$i]);
            } else {
                $stars = "";
            }
            $html .= $i . ": " . $stars . "<br>";
        }
        
        return $html;
    }
}
