<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'imagePath' => $this->faker->imageUrl(640, 480, 'animals', true),
            'imageable_id' => $this->faker->numberBetween(1, 10),
            'imageable_type' => $this->faker->randomElement(['App\Models\Post', 'App\Models\Comment'])
        ];
    }
}
