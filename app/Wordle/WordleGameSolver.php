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
        $this->guess();
//        $this->guesses[] = $this->game->guessRow('whack'); // make guess that the word is 'whack'. returns validation Row::class object.
    }

    public function analyse()
    {
        foreach ($this->guesses as $guess)
        {
            foreach ($guess->getArrayWord() as $letter)
            {
                //foreach incorrect letter, remove word with that letter.
                //throwback leftover words into $this->wordList.
                if($letter['position'] === ROW::POSITION_NONE)
                {
                    dump($letter['letter']." -> zit er niet in!"); //todo: remove this dump
                    $this->wordList = preg_grep("/".$letter['letter']."/", $this->wordList, PREG_GREP_INVERT);
                }
            }
        }

        dump($this->wordList);
        //foreach guesses filter woordlijst
    }

    public function guess()
    {
        //this game guessRow()
        $this->guesses[] = $this->game->guessRow('valid'); // make guess that the word is 'whack'. returns validation Row::class object.
        $this->analyse();
//        return $this->guesses[] = $this->game->guessRow(reset($this->wordList));
    }
}
