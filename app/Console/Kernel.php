<?php

namespace App\Console;

use App\Console\Commands\FakeCreateRandomContractCommand;
use App\Console\Commands\FakeOpenRandomCaseCommand;
use App\Console\Commands\GiveAwayCommand;
use App\Console\Commands\SellDropsCommand;
use App\Console\Commands\SellItemsCommand;
use App\Console\Commands\UpdateItemsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        GiveAwayCommand::class,
        SellItemsCommand::class,
        UpdateItemsCommand::class,
        FakeOpenRandomCaseCommand::class,
        FakeCreateRandomContractCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('giveaway:check')->everyTenMinutes();
        $schedule->command('items:sell')->everyThirtyMinutes();
        $schedule->command('items:update')->daily();
        $schedule->command('fake-random-open-case')->everyMinute();
        $schedule->command('fake-create-random-contract')->hourly();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
