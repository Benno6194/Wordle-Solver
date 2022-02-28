<?php

namespace App\Wordle;

class Row
{
    public const POSITION_NONE = 1;
    public const POSITION_WRONG = 2;
    public const POSITION_CORRECT = 3;

    private $word;
    private $arrayWord;
    private $isSolution;

    public function __construct($word)
    {
        $this->word = implode($word);
        $this->arrayWord = array_map(function($l) {
            return [
                'letter' => $l,
                'position' => null
            ];
        },$word);

        $this->isSolution = false;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @return array
     */
    public function getArrayWord()
    {
        return $this->arrayWord;
    }

    public function validate($solution)
    {
        $splitSolution = str_split($solution);

        $correctCounter = 0;
        foreach($this->getArrayWord() as $key => $letterRow) {

            if($splitSolution[$key] === $letterRow['letter']) {
                $correctCounter ++;
                $this->arrayWord[$key]['position'] = self::POSITION_CORRECT;
            }elseif(in_array($letterRow['letter'], $splitSolution)) {
                $this->arrayWord[$key]['position'] = self::POSITION_WRONG;
            }else {
                $this->arrayWord[$key]['position'] = self::POSITION_NONE;
            }
        }

        if($this->getWord() === $solution) {
            $this->isSolution = true;
        }

        return $this;
    }

    /**
     * @return false
     */
    public function isSolution()
    {
        return $this->isSolution;
    }
}
