<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testStatus()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    // Model
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // JSON API
    public function test_index_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/products');

        $response->assertStatus(200);
    }

    public function test_create_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('POST', '/products', [
            'name' => 'Create product JSON',
            'substance_id' => 5,
            'maker_id' => 5,
            'price' => 100,
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'substance',
                    'maker',
                    'price',
                ],
            ]);
    }

    public function test_update_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('PATCH', '/products/1', [
            'name' => 'Update product JSON',
            'price' => 250,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'substance',
                    'maker',
                    'price',
                ],
            ]);
    }

    public function test_destroy_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('DELETE', '/products/1', []);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'substance',
                    'maker',
                    'price',
                ],
            ]);
    }

    public function test_filter_index_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/products', [
            'maker_id' => 1
        ]);

        $response->assertStatus(200);
    }

    public function test_failed_filter_index_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/products', [
            'maker_id' => 'string'
        ]);

        $response->assertStatus(422);
    }


    // WEB API
    public function test_index_api_web()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function test_create_api_web()
    {
        $response = $this->post('/products', [
            'name' => 'Create product WEB',
            'substance_id' => 1,
            'maker_id' => 1,
            'price' => 50,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_api_web()
    {
        $response = $this->patch('/products/5', [
            'name' => 'Update product WEB',
        ]);

        $response->assertStatus(302);
    }

    public function test_destroy_api_web()
    {
        $response = $this->delete('/products/5');
        $response->assertStatus(302);
    }

    public function test_filter_index_api_web()
    {
        $response = $this->json( 'GET', '/products', [
            'maker_id' => 1,
        ]);

        $response->assertStatus(200);
    }

    public function test_failed_filter_index_api_web()
    {
        $response = $this->json('GET', '/products', [
            'maker_id' => 'string',
        ]);

        $response->assertStatus(422);
    }
}
