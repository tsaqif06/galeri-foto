<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->unique()->userName(),
            'description' => $this->faker->sentence(10),
            'password' => Hash::make('password123'),
            'role_id' => $this->faker->numberBetween(1, 3),
            'stripe_account_id' => $this->faker->optional()->regexify('acct_[0-9a-zA-Z]{16}'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id_tag');
            $user->tags()->attach($tags);
        });
    }
}
