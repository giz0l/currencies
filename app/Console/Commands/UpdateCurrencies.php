<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NBP;
use App\Models\Currency;
use DB;

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
        $table = $nbp->getCurrency("B");

        foreach($table->rates as $rate){
            try {
                DB::beginTransaction();

                $currency = Currency::updateOrCreate(
                    [
                        'currency_code'   => $rate->code,
                    ],
                    [
                        'name' => $rate->currency,
                        'currency_code' => $rate->code,
                        'exchange_rate' =>  (int) round((1/$rate->mid)*100)
                    ]
                );

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                dd($exception);
            }
        }
    }
}
