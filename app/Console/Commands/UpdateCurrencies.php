<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NBP;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nbp = new NBP();
        $table = $nbp->getCurrency("A");
        
        dd($table);
    }
}
