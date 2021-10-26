<?php

namespace App\Console\Commands;

use App\Models\Item;
use Buglinjo\LaravelWebp\Webp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;

class DownloadAndChangeCaseImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download-and-resize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloading item img and resizing';

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
        $items = Item::all();

        foreach ($items as $item) {
            sleep(1);
            $item->setLocalImg($item->remoteImgUrl);
        }

        return 0;
    }
}
