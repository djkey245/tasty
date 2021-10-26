<?php

namespace App\Console\Commands;

use App\Models\GiveAway;
use Illuminate\Console\Command;

class GiveAwayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'giveaway:check';

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
        $ended_giveaways = GiveAway::where('active', 1)->where('every_few_days','>', 0)->where('end','<=', now())->get();

        foreach ($ended_giveaways as $ended_giveaway){
            $ended_giveaway->end = now()->addDays($ended_giveaway->every_few_days);
            $ended_giveaway->save();
        }
    }
}
