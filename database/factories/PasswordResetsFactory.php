<?php

namespace Database\Factories;

use App\Models\password_resets;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasswordResetsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = password_resets::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}
