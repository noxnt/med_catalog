<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SubstanceTest extends TestCase
{
    use DatabaseTransactions;

    public function testStatus()
    {
        $response = $this->get('/substances');
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
        ])->json('GET', '/substances');

        $response->assertStatus(200);
    }

    public function test_create_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('POST', '/substances', [
            'name' => 'Create substance JSON',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'products',
                ],
            ]);
    }

    public function test_update_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('PATCH', '/substances/1', [
            'name' => 'Update substance JSON',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'products',
                ],
            ]);
    }

    public function test_filter_index_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/substances', [
            'name' => '*',
        ]);

        $response->assertStatus(200);
    }

    public function test_failed_filter_index_api_json()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/substances', [
            'name' => 1,
        ]);

        $response->assertStatus(422);
    }


    // WEB API
    public function test_index_api_web()
    {
        $response = $this->get('/substances');
        $response->assertStatus(200);
    }

    public function test_create_api_web()
    {
        $response = $this->post('/substances', [
            'name' => 'Create substance WEB',
        ]);

        $response->assertStatus(302);
    }

    public function test_update_api_web()
    {
        $response = $this->patch('/substances/5', [
            'name' => 'Update substance WEB',
        ]);

        $response->assertStatus(302);
    }

    public function test_destroy_api_web()
    {
        $response = $this->delete('/substances/5');
        $response->assertStatus(302);
    }

    public function test_filter_index_api_web()
    {
        $response = $this->json( 'GET', '/substances', [
            'name' => '*',
        ]);

        $response->assertStatus(200);
    }

    public function test_failed_filter_index_api_web()
    {
        $response = $this->json('GET', '/substances', [
            'name' => true,
        ]);

        $response->assertStatus(422);
    }
}
