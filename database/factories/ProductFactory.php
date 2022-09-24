<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use GetCandy\Models\Product;
use GetCandy\FieldTypes\TranslatedText;
use GetCandy\FieldTypes\Text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'product_type_id' => 1,
            'status' => 'published',
            'brand' => 'Foo',
            'attribute_data' => [
                'name' => new TranslatedText(collect([
                    'en' => new Text(fake()->name()),
                ])),
                'description' => new Text(fake()->text(250)),
            ],
        ];
    }
}
