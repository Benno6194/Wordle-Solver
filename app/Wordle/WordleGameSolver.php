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

        $this->guesses[] = $this->game->guessRow('valid'); // make guess that the word is 'whack'. returns validation Row::class object.
    }

    public function analyse()
    {
        //foreach guesses filter woordlijst
    }

    public function guess()
    {
        //this game guessRow()
        $this->analyse();
        $this->guesses[] = $this->game->guessRow(reset($this->wordList));
    }
}
