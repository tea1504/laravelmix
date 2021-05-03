<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'	=> $this->faker->lastName(),
            'date_of_birth'	=> $this->faker->dateTimeBetween('-50 years', '-22 years', null),
            'identity_card_number' => $this->faker->numerify('############'),
            'phone_number' => $this->faker->numerify('##########'),
            'address' => $this->faker->address(),
            'username' => $this->faker->userName(),
            'password' => Hash::make('12345')
        ];
    }
}
