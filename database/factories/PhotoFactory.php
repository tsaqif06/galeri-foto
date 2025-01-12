<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'user_id' => User::where('role_id', 2)->inRandomOrder()->first()->id_user,
            'file_name' => $this->faker->unique()->word() . '.jpg',
            'file_path' => 'https://picsum.photos/200',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['file_name'] . '-' . Str::random(6));
            },
            'price' => $this->faker->randomFloat(2, 5, 50),
            'views' => $this->faker->numberBetween(10, 500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
