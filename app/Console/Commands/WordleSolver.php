<?php

namespace App\Console\Commands;

use App\Wordle\Game;
use App\Wordle\WordleGameSolver;
use Illuminate\Console\Command;

class WordleSolver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordle:solve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $wordle;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->wordle = new Game();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $solver = new WordleGameSolver();

        $solver->start($this->wordle);

        return 1;
    }
}
