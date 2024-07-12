<?php

namespace Database\Factories;

use App\Models\Officer;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Officer>
 */
class OfficerFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Officer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'nip' => $this->faker->unique()->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
