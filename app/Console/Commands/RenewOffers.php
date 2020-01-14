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
    protected $signature = 'offers:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the created_at field of all the offers have been created two months ago in the database with today\'s date';

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
        $twoMonthAgo = Carbon::now()->subMonth(2);
        Offer::where('created_at', '<=', $twoMonthAgo)
            ->orWhere('updated_at', '<=', $twoMonthAgo)
            ->update(['created_at'=> Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
