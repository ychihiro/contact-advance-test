<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name,
            'gender' => $this->faker->numberBetween(1, 2),
            'email' => $this->faker->safeEmail(),
            'postcode' => $this->faker->postcode(),
            'address' => $this->faker->streetAddress(),
            'building_name' => $this->faker->secondaryAddress(),
            'opinion' => $this->faker->realText(40)
        ];
    }
}
