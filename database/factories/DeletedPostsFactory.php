<?php

namespace Database\Factories;

use App\Models\deleted_posts;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeletedPostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = deleted_posts::class;

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
