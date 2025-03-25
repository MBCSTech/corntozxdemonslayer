<?php

namespace Database\Factories;

use App\Models\PlayerForm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlayerForm::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'no_ic' => $this->faker->numerify('##########'), // Assuming a 10-digit IC number
            'no_fon' => $this->faker->numerify('+60#########'), // Malaysian phone number format
            'score' => $this->faker->numberBetween(0, 1000),
            'resit' => $this->faker->optional()->uuid(), // Optional receipt reference
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Indicate that the player has no score yet.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutScore(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'score' => null,
            ];
        });
    }

    /**
     * Indicate that the player has no receipt.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutReceipt(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'resit' => null,
            ];
        });
    }
}