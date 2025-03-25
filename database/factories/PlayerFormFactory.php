<?php

namespace Database\Factories;

use App\Models\PlayerForm;
use Carbon\Carbon;
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
        $weeks = [
            'Week1' => ['start' => '2024-06-01', 'end' => '2024-06-14'],
            'Week2' => ['start' => '2024-06-15', 'end' => '2024-06-28'],
            'Week3' => ['start' => '2024-06-29', 'end' => '2024-07-12'],
            'Week4' => ['start' => '2024-07-13', 'end' => '2024-07-26'],
            'Week5' => ['start' => '2024-07-27', 'end' => '2024-08-09'],
            'Week6' => ['start' => '2024-08-10', 'end' => '2024-08-23'],
            'Week7' => ['start' => '2024-08-24', 'end' => '2024-09-06'],
            'Week8' => ['start' => '2024-09-07', 'end' => '2024-09-13']
        ];

        $selectedWeek = $this->faker->randomElement(array_keys($weeks));
        $weekDetails = $weeks[$selectedWeek];

        $createdAt = $this->faker->dateTimeBetween(
            Carbon::parse($weekDetails['start']),
            Carbon::parse($weekDetails['end'])
        );

        return [
            'nama' => $this->faker->name(),
            'no_ic' => $this->faker->numerify('##########'), // Assuming a 10-digit IC number
            'no_fon' => $this->faker->numerify('+60#########'), // Malaysian phone number format
            'score' => $this->faker->numberBetween(0, 1000),
            'resit' => $this->faker->optional()->uuid(), // Optional receipt reference
            'week' => $selectedWeek,
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
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

    /**
     * Specify a specific week for the player form.
     *
     * @param string $week
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function forWeek(string $week): Factory
    {
        $weeks = [
            'Week1' => ['start' => '2024-06-01', 'end' => '2024-06-14'],
            'Week2' => ['start' => '2024-06-15', 'end' => '2024-06-28'],
            'Week3' => ['start' => '2024-06-29', 'end' => '2024-07-12'],
            'Week4' => ['start' => '2024-07-13', 'end' => '2024-07-26'],
            'Week5' => ['start' => '2024-07-27', 'end' => '2024-08-09'],
            'Week6' => ['start' => '2024-08-10', 'end' => '2024-08-23'],
            'Week7' => ['start' => '2024-08-24', 'end' => '2024-09-06'],
            'Week8' => ['start' => '2024-09-07', 'end' => '2024-09-13']
        ];

        return $this->state(function (array $attributes) use ($week, $weeks) {
            $weekDetails = $weeks[$week];
            $createdAt = $this->faker->dateTimeBetween(
                Carbon::parse($weekDetails['start']),
                Carbon::parse($weekDetails['end'])
            );

            return [
                'week' => $week,
                'created_at' => $createdAt,
                'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
            ];
        });
    }
}