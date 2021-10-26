<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserItem;
use Illuminate\Console\Command;

class SellItemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:sell';

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
        $user_items = UserItem::where([['status', '=', 'wait'], ['created_at', '<=', now()->subMinutes(180)->toDateTimeString()]])->get();
        foreach ($user_items as $user_item) {
            $user = User::find($user_item->user_id);
            $item = $user_item->item;
            $price = $item->price;
            $user_item->update(['status' => 'pay']);
            $user->update(['balance' => $user->balance + $price]);

        }
    }
}
