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
            'Week1' => ['start' => '2024-06-01', 'end' => '2024-06-08'],
            'Week2' => ['start' => '2024-06-09', 'end' => '2024-06-15'],
            'Week3' => ['start' => '2024-06-16', 'end' => '2024-06-22'],
            'Week4' => ['start' => '2024-06-23', 'end' => '2024-06-29'],
            'Week5' => ['start' => '2024-06-30', 'end' => '2024-07-06'],
            'Week6' => ['start' => '2024-07-07', 'end' => '2024-07-13'],
            'Week7' => ['start' => '2024-07-14', 'end' => '2024-07-20'],
            'Week8' => ['start' => '2024-07-21', 'end' => '2024-07-31']
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
            'receipt' => 'uid81_989029490282.png', // Optional receipt reference
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
                'receipt' => 'resit/uid81_989029490282.png',
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
            'Week1' => ['start' => '2024-06-01', 'end' => '2024-06-08'],
            'Week2' => ['start' => '2024-06-09', 'end' => '2024-06-15'],
            'Week3' => ['start' => '2024-06-16', 'end' => '2024-06-22'],
            'Week4' => ['start' => '2024-06-23', 'end' => '2024-06-29'],
            'Week5' => ['start' => '2024-06-30', 'end' => '2024-07-06'],
            'Week6' => ['start' => '2024-07-07', 'end' => '2024-07-13'],
            'Week7' => ['start' => '2024-07-14', 'end' => '2024-07-20'],
            'Week8' => ['start' => '2024-07-21', 'end' => '2024-07-31']
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
