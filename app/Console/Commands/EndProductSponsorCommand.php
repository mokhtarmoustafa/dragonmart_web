<?php

namespace App\Console\Commands;

use App\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EndProductSponsorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'end:sponsor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End sponsor duration';

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
        //

        Product::where('admin_is_sponsor', 1)->whereDate('end_date_sponsor','<=', Carbon::now()->format('Y-m-d H:i'))->update(['admin_is_sponsor' => 0]);

    }
}
