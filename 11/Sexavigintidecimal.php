<?php

class Sexaviginitidecimal
{
    /**
     * @var int[]
     */
    private $digits = [];

    private $changed = true;

    private $string = '';

    /**
     * Sexaviginitidecimal constructor.
     *
     * @param string $number
     * @throws InvalidArgumentException
     */
    public function __construct($number)
    {
        $chars = str_split($number);
        foreach ($chars as $char) {
            if ('a' <= $char && $char <= 'z') {
                $this->digits[] = ord($char) - ord('a');
            } else {
                $this->digits = [];
                throw new InvalidArgumentException();
            }
        }
    }

    public function increment() {
        $this->changed = true;
        $length = count($this->digits);
        $this->incrementDigit($length - 1);
    }

    /**
     * @param int $digit
     */
    private function incrementDigit($digit) {
        $this->digits[$digit] += 1;
        if ($this->digits[$digit] > 25) {
            $this->digits[$digit] = 0;
            $this->incrementDigit($digit - 1);
        }
    }

    /**
     * @return bool
     */
    public function containsSequentialTriplet() {
        $length = count($this->digits);

        $triplet = false;
        for ($i = 0; $i < $length - 2 && !$triplet; ++$i) {
            $digit = $this->digits[$i];
            $triplet = ($this->digits[$i + 1] == $digit + 1) && ($this->digits[$i + 2] == $digit + 2);
        }

        return $triplet;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->changed) {
            $this->string = '';
            foreach ($this->digits as $digit) {
                $this->string .= chr($digit + ord('a'));
            }

            $this->changed = false;
        }

        return $this->string;
    }
}
