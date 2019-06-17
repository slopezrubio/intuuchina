<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Offer;


class RenewOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offer:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renovación de las ofertas publicadas de más de 2 meses';

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
     * @return mixed
     */
    public function handle()
    {
        $TwoMonthAgo = Carbon:: now()->subMonth(2);
        $result = Offer::where('created_at', '<=', $TwoMonthAgo)->update(['created_at'=> Carbon:: now()]);
        echo $result;

    }
}
