<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 'company_id' => factory('App\Company')->create()->id,
        // 'first_name' => $faker->firstName(),
        // 'last_name' => $faker->lastName,
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'avatar' => 'https://source.unsplash.com/random',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'password' => Hash::make("password"), // password
            'status' => $this->faker->randomElement(['active', 'deactive']),
            'remember_token' => $this->faker->regexify('[A-Za-z0-9]{20}'),
        ];
    }
}
