<?php

namespace Database\Seeders;

use App\Models\kk;
use App\Models\warga;
use Illuminate\Database\Seeder;

class kkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kk::factory()->count(10)->create()->each(function ($kk) {
            $w = warga::factory()->count(5)->make();
            $kk->warga()->saveMany($w);
        });

    }
}
