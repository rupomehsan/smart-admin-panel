<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SmartFormValidation>
 */
class SmartFormValidationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'phone' => $this->faker->numberBetween(0, 9),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(),
            'address' => $this->faker->address(),
            'image' => $this->faker->imageUrl(),
            'image_sec' => $this->faker->imageUrl(),
            'color' => $this->faker->colorName(),
            'switch' => "on",
            'category_id' => $this->faker->numberBetween(1, 9),
            'description' => $this->faker->paragraph(),
            'description2' => $this->faker->paragraph(),
            'date_time' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'start_time' => $this->faker->dateTime(),
            'status' => "active",
            'chips' => ["one", "two", "three"],
            'multi_chips_select' => ["one", "two", "three", "four", "five"],
            'days' => ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"],
            'single_item' => ["One", "Two", "three"],
            'multi_item' =>  [
                ["one" => "abcd", "two" => "efgh", "three" => "ijkl", "four" => "mnop"],
                ["one" => "abceeeed", "two" => "efgh", "three" => "ijkl", "four" => "mnop"],
                ["one" => "abcdfffff", "two" => "efgh", "three" => "ijkl", "four" => "mnop"]
            ],
            'multi_category_selector' => ["1", "2", "3", "8"],
        ];
    }
}