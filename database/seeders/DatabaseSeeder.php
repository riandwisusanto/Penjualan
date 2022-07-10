<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Config::where('id', 1)->delete();
        Config::create(['id'=> 1, 'name' => 'Penjualan', 'logo' => 'logo.png']);
    }
}
