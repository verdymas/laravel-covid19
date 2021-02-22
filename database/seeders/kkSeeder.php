<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\kk;
use App\Models\warga;

class kkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	kk::factory()
        ->haswarga(5)
    	->create();
    }
}
