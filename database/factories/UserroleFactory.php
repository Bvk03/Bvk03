<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Userrole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserroleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Userrole::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,2),
            'role_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
