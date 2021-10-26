<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\SteamApiService;
use Illuminate\Console\Command;

class SetBiggerSteamAvatarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:bigger-avatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'setting for all steam users avatartfull field like avatar';

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
    public function handle(SteamApiService $steamApiService)
    {
        $users = User::where('provider', 'steam')->get();
        foreach ($users as $user) {
            $avatar_url = $steamApiService->getUserAvatar($user->provider_uid);
            var_dump($avatar_url);
            $user->img = $avatar_url;
            sleep('10');
        }

        return 0;
    }
}
