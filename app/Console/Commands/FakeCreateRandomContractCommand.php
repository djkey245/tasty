<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\UserItem;
use Illuminate\Console\Command;

class FakeCreateRandomContractCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-create-random-contract';

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
        $minCount = setting('contractmake.minCount');
        $maxCount = setting('contractmake.maxCount');
        $minDelay = setting('contractmake.minDelay');
        $maxDelay = setting('contractmake.maxDelay');

        $lotcaseCount = random_int($minCount, $maxCount);

        $items = Item::query()->inRandomOrder()->limit($lotcaseCount)->get();
        foreach ($items as $item) {
            sleep(random_int($minDelay, $maxDelay));

            UserItem::fakeContractMake($item);
        }
        return 0;
    }
}
