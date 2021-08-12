<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MakerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStatus()
    {
        $response = $this->get('/makers');
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
        ])->json('GET', '/makers');

        $response->assertStatus(200);
    }

    public function test_create_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('POST', '/makers', [
            'name' => 'Create maker JSON',
            'link' => 'https://test.com',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'link',
                    'products',
                ],
            ]);
    }

    public function test_update_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('PATCH', '/makers/1', [
            'name' => 'Update maker JSON',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'link',
                    'products',
                ],
            ]);
    }

    public function test_filter_index_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/makers', [
            'name' => '*',
        ]);

        $response->assertStatus(200);
    }

    public function test_failed_filter_index_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/makers', [
            'name' => 1,
        ]);

        $response->assertStatus(422);
    }


    // WEB API
    public function test_index_api_web()
    {
        $response = $this->get('/makers');
        $response->assertStatus(200);
    }

    public function test_create_api_web()
    {
        $response = $this->post('/makers', [
            'name' => 'Create maker WEB',
        ]);

        $response->assertStatus(302);
    }

    public function test_update_api_web()
    {
        $response = $this->patch('/makers/5', [
            'name' => 'Update maker WEB',
        ]);

        $response->assertStatus(302);
    }

    public function test_destroy_api_web()
    {
        $response = $this->delete('/makers/5');
        $response->assertStatus(302);
    }

    public function test_filter_index_api_web()
    {
        $response = $this->json( 'GET', '/makers', [
            'name' => '*',
        ]);

        $response->assertStatus(200);
    }

    public function test_failed_filter_index_api_web()
    {
        $response = $this->json('GET', '/makers', [
            'name' => true,
        ]);

        $response->assertStatus(422);
    }
}
