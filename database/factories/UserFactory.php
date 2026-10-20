<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4Koyhh518U2ZiE/uTN.Fh7q7Vq/IRXs',
            'remember_token' => Str::random(10),
        ];
    }
}