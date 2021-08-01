<?php

namespace Database\Factories;

use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;
    private $index = 0;

    /**
     * Define the model's default state.
     *
     * @throws Exception
     *
     * @return array
     */

    public function definition(): array
    {
        $this->index++;

        return [
            'id'          => $this->index,
            'title'       => 'Товар ' . random_int(10, 99),
            'description' => 'Описание товара ' . random_int(10, 99),
            'options'     => strval(random_int(1000, 9999)),
            'created_at'  => null,
            'updated_at'  => null,
        ];
    }
}
