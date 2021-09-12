<?php

namespace Database\Factories;

use App\Models\TestTable;
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
        return [
            'municipio' => Str::random(10),
            'centro' => Str::random(10),
            'indicador' => Str::random(10),
            'ner' => 97, // password
        ];
    }
}
