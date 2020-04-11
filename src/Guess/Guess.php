<?php

namespace Lefty\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number > 0 ? $number : $this->random();
        $this->tries = $tries;
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        return rand(1, 100);
    }


    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }

    /**
     * Cheat function
     *
     * @return string with active number.
     */
    public function cheat()
    {
        return "CHEAT: " . $this->number;
    }

    /**
     * Check that input is number between 1 -100.
     *
     * @return True or throw Exception.
     */
    private function isValid($number)
    {
        if ($number > 0 and $number <= 100) {
            return true;
        }
        throw new GuessException("Not a valid number");
    }
    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($number)
    {
        if ($this->tries > 0 and $this->isValid($number)) {
            if ($number == $this->number) {
                $string = $number . " är RÄTT!";
            } elseif ($number < $this->number) {
                $string = $number . " är för lågt...";
            } else {
                $string = $number . " är för högt...";
            }
            $this->tries--;
        } else {
            $string = "Du har inga försök kvar.";
        }
        return $string;
    }
}
