<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\User;
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
            'file_path' => $this->faker->imageUrl(640, 480, 'nature', true, 'photo'), // Dummy URL
            'price' => $this->faker->randomFloat(2, 5, 50), // Harga antara 5.00 - 50.00
            'views' => $this->faker->numberBetween(10, 500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}