<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\ItemController;
use App\Models\Lotcase;
use Illuminate\Console\Command;

class UpdateItemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:update';

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
        $controller = new ItemController();
        $cases = Lotcase::where('active', 1)->where('auto_updating', 1)->get();
        foreach ($cases as $case) {
            $controller->updateAll($case);
            sleep(15);
        }
        return;
    }
}
