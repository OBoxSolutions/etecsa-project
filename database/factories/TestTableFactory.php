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
        $indicators = ['ldne', 'ldie'];
        $centers = ['Caibarién', 'Cayo Santa María', 'Lagunas del Este', 'Dolores'];
        return [
            'municipality' => Str::random(10),
            'center' => $centers[rand(0, 3)],
            'NerLDNE' => rand(80, 100),
            'NerLDIE' => rand(80, 100), // password
        ];
    }
}
