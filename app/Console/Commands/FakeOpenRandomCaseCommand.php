<?php

namespace App\Console\Commands;

use App\Events\LotCaseOpen;
use App\Models\Lotcase;
use App\Models\LotcaseOpened;
use App\Services\OpenCaseService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class FakeOpenRandomCaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-random-open-case';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Opening random case from fake user';

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
        $minCaseOpenCount = intval(setting('opencase.minCount'));
        $maxCaseOpenCount = intval(setting('opencase.maxCount'));
        $minOpenDelay = intval(setting('opencase.minDelay'));
        $maxOpenDelay = intval(setting('opencase.maxDelay'));
        $caseCount = rand($minCaseOpenCount, $maxCaseOpenCount);
        $cases = Lotcase::inRandomOrder()->limit($caseCount)->get();
        $service = app()->make(OpenCaseService::class);
        foreach ($cases as $case) {
            sleep(rand($minOpenDelay, $maxOpenDelay));
            $drop = $service->generate($case);

            event(new LotCaseOpen($drop, false));
            $lotcaseOpened = new LotcaseOpened([
                'lotcase_id' => $case->id,
                'item_id' => $drop->id,
                'item_price' => $drop->price,
                'case_price' => $case->price,
                'user_id' => config('fake-open.user_id')
            ]);
            $lotcaseOpened->save();
        }
        return 0;
    }
}
