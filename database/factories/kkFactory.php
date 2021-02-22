<?php

namespace Database\Factories;

use App\Models\kk;
use Illuminate\Database\Eloquent\Factories\Factory;
use DB;

class kkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = kk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $id = DB::select("SHOW TABLE STATUS LIKE 'kk'");
        // $next_id = $id[0]->Auto_increment;
        return [            
            'no_kk' => $this->faker->unique()->numberBetween(100000000000, 999999999999),
            'stat_kk' => '1',
        ];
    }
}
