<?php

namespace Database\Factories;

use App\Models\TestTable;
use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestTableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestTable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $indicator = ['ldne', 'ldie'];
        return [
            'municipality' => Str::random(10),
            'center' => Str::random(10),
            'indicator' => $indicator[rand(0, 1)],
            'ner' => 97, // password
        ];
    }
}
