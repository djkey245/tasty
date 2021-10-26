<?php

namespace Database\Seeders;

use App\Models\ChanceRange;
use Illuminate\Database\Seeder;

class ChanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChanceRange::create(['range_start' => 0, 'range_stop' => 0]);
        ChanceRange::create(['range_start' => 0, 'range_stop' => 999999]);
        ChanceRange::create(['range_start' => 10000000, 'range_stop' => 20000000]);
        ChanceRange::create(['range_start' => 99999, 'range_stop' => 999999]);
    }
}
