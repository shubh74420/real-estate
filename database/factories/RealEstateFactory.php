<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {

        $real_estate_type   = ['house', 'department', 'land', 'commercial_ground'];
        $random_type        = rand(0,3);
        $bathrooms          = rand(0, 12);
        $external_number    = rand(0, 12);
        $internal_number    = rand(0, 12);
        $rooms              = rand(0, 12);

        if (
            array_intersect(
                [$real_estate_type[$random_type]],
                ['land', 'commercial_ground']
            )
        )
            $bathrooms = 0;

        return [
            'name'              => $this->faker->name,
            'real_estate_type'  => $real_estate_type[$random_type],
            'street'            => $this->faker->streetName,
            'external_number'   => $external_number,
            'internal_number'   => $internal_number,
            'neighborhood'      => $this->faker->name,
            'city'              => $this->faker->city,
            'country'           => $this->faker->countryCode ,
            'rooms'             => $rooms,
            'bathrooms'         => $bathrooms,
            'comments'          => $this->faker->realText(128),
        ];
    }
}

