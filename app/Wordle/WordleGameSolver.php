<?php

namespace App\Wordle;

class WordleGameSolver
{
    /** @var Game */
    private $game;
    private $wordList;
    private $guesses = [];

    public function start(Game $game)
    {
        $this->game = $game;
        $this->wordList = $game->wordlist;
        $this->guesses[] = $this->game->guessRow('opera'); // make guess that the word is 'whack'. returns validation Row::class object.
    }

    /**
     * @return array
     */
    public function getGuesses(): array
    {
        return $this->guesses;
    }

    public function analyse()
    {
        foreach ($this->guesses as $guess)
        {
            foreach ($guess->getArrayWord() as $key=> $letter)
            {
                //foreach incorrect letter, remove word with that letter.
                //throwback leftover words into $this->wordList.
                if($letter['position'] === Row::POSITION_NONE) {
                    $this->filterHasNone($letter['letter']);
                }

                if($letter['position'] === Row::POSITION_WRONG) {
                    $this->filterHasLetterDifferentPosition($letter['letter'], $key);
                }

                if($letter['position'] === Row::POSITION_CORRECT) {
                    $this->filterHasLetterOnPosition($letter['letter'], $key);
                }
            }
        }
    }

    private function filterHasLetterOnPosition($letter, $key)
    {
        $this->wordList = array_filter(
            $this->wordList,
            function ($word) use ($letter, $key) {
                return str_split($word)[$key] === $letter;
            }
        );
    }

    private function filterHasLetterDifferentPosition($letter, $key)
    {
        $this->wordList = array_filter(
            $this->wordList,
            function ($word) use ($letter, $key) {
                return
                    str_contains($word, $letter) === true &&
                    str_split($word)[$key] !== $letter;
            }
        );
    }

    private function filterHasNone(string $letter)
    {
        $this->wordList = array_filter(
            $this->wordList,
            function($word) use ($letter){
                return str_contains($word, $letter) === false;
            }
        );
    }

    public function guess()
    {
        //this game guessRow()
        $this->analyse();

        // guess
        $this->guesses[] = $this->game->guessRow(reset($this->wordList));
    }
}
