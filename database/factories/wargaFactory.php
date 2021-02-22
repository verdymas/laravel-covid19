<?php

namespace Database\Factories;

use App\Models\warga;
use App\Models\kk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class wargaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = warga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);

        return [
            'nm_wrg' => $faker->name($gender),
            'tmplhr_wrg' => 'Kediri',
            'tgllhr_wrg' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'jk_wrg' => $gender == 'male' ? 1 : 0,
            'almt_wrg' => $faker->address,
            'skt_wrg' => '',
            'statskt_wrg' => 0,
            'stat_wrg' => 1,
            'id_kk' => kk::factory()->create()->id,
        ];
    }
}
