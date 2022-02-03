<?php

namespace Tests\Feature;

use App\Models\RealEstate;
use Tests\TestCase;

class RealEstateTest extends TestCase
{
    /**
     * Test To Get All
     *
     * @return void
     */
    public function testGetList()
    {
        $mockData =  RealEstate::factory()->create();
        $this->json('GET', 'api/real_estate', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson(
                [
                    [
                        "name"              => $mockData->name,
                        "real_estate_type"  => $mockData->real_estate_type,
                        "city"              => $mockData->city,
                        "country"           => $mockData->country,
                    ]
                ]
            );
    }

    /**
     * Test For Show All
     *
     * @return void
     */
    public function testGetById()
    {
        $mockData =  RealEstate::factory()->create();
        $this->json('GET', "api/real_estate/$mockData->id", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson(
                [
                    "id"                => $mockData->id,
                    "name"              => $mockData->name,
                    "real_estate_type"  => $mockData->real_estate_type,
                    "street"            => $mockData->street,
                    "external_number"   => $mockData->external_number,
                    "internal_number"   => $mockData->internal_number,
                    "neighborhood"      => $mockData->neighborhood,
                    "city"              => $mockData->city,
                    "country"           => $mockData->country,
                    "rooms"             => $mockData->rooms,
                    "bathrooms"         => $mockData->bathrooms,
                    "comments"          => $mockData->comments,
                    "deleted_at"        => null,
                ]
            );
    }

    /**
     * Test For Delete
     *
     * @return void
     */
    public function testDelete()
    {
        $mockData =  RealEstate::factory()->create();
        $this->json('DELETE', "api/real_estate/$mockData->id", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson(
                [
                    "id"                => $mockData->id,
                    "name"              => $mockData->name,
                    "real_estate_type"  => $mockData->real_estate_type,
                    "street"            => $mockData->street,
                    "external_number"   => $mockData->external_number,
                    "internal_number"   => $mockData->internal_number,
                    "neighborhood"      => $mockData->neighborhood,
                    "city"              => $mockData->city,
                    "country"           => $mockData->country,
                    "rooms"             => $mockData->rooms,
                    "bathrooms"         => $mockData->bathrooms,
                    "comments"          => $mockData->comments,
                ]
            );
    }

    /**
     * Return error message when create with null property
     *
     * @return void
     */
    public function testCreateWithNull()
    {
        $this->json('POST', "api/real_estate", ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => [
                        "The name field is required."
                    ],
                    "real_estate_type" => [
                        "The real estate type field is required."
                    ],
                    "street" => [
                        "The street field is required."
                    ],
                    "external_number" => [
                        "The external number field is required."
                    ],
                    "neighborhood" => [
                        "The neighborhood field is required."
                    ],
                    "city" => [
                        "The city field is required."
                    ],
                    "country" => [
                        "The country field is required."
                    ],
                    "rooms" => [
                        "The rooms field is required."
                    ],
                    "bathrooms" => [
                        "The bathrooms field is required."
                    ]
                ],
                "status" => 422
            ]);
    }

    /**
     * Country is invalid when enter invalid country code
     *
     * @return void
     */
    public function testWithInvalidCountryForPost()
    {
        $mockData =  RealEstate::factory()->make();
        $postData = $mockData->toArray();
        $postData['country'] = 'XS';

        $this->json('POST', "api/real_estate", $postData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "country" => [
                        "The XS is not valid country code."
                    ],
                ],
                "status" => 422
            ]);
    }

    /**
     * Required internal-number when type is `department`
     *
     * @return void
     */
    public function testRequiredInternalNumberWhenTypeIsDepartment()
    {
        $mockData =  RealEstate::factory()->make();
        $postData = $mockData->toArray();
        $postData['real_estate_type'] = 'commercial_ground';
        $postData['internal_number'] = '';

        $this->json('POST', "api/real_estate", $postData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "internal_number" => [
                        "The internal number field is required."
                    ],
                ],
                "status" => 422
            ]);
    }

    /**
     * Create
     *
     * @return void
     */
    public function testCreate()
    {
        $mockData =  RealEstate::factory()->make();
        $postData = $mockData->toArray();
        $this->json('POST', "api/real_estate", $postData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    "id",
                    "name",
                    "real_estate_type",
                    "street",
                    "external_number",
                    "internal_number",
                    "neighborhood",
                    "city",
                    "country",
                    "rooms",
                    "bathrooms",
                    "comments",
                    "updated_at",
                    "created_at",
                ]
            );
    }

    /**
     * Update
     *
     * @return void
     */
    public function testUpdate()
    {
        $mockData =  RealEstate::factory()->create();
        $updateData = $mockData->toArray();
        $updateData['name'] = 'Albert';
        $this->json('PUT', "api/real_estate/$mockData->id", $updateData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson(
                [
                    "id"                => $mockData->id,
                    "name"              => $updateData['name'],
                    "real_estate_type"  => $mockData->real_estate_type,
                    "street"            => $mockData->street,
                    "external_number"   => $mockData->external_number,
                    "internal_number"   => $mockData->internal_number,
                    "neighborhood"      => $mockData->neighborhood,
                    "city"              => $mockData->city,
                    "country"           => $mockData->country,
                    "rooms"             => $mockData->rooms,
                    "bathrooms"         => $mockData->bathrooms,
                    "comments"          => $mockData->comments,
                    "deleted_at"        => null,
                ]
            );
    }
}
