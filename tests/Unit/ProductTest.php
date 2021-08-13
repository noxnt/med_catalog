<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    // Status
    public function testStatusIndex()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function testStatusEdit()
    {
        $response = $this->get('/products/1/edit');
        $response->assertStatus(200);
    }

    // Model
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // JSON API
    public function testIndexApiJson()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/products');

        $response->assertStatus(200);
    }

    public function testCreateApiJson()
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

    public function testUpdateApiJson()
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

    public function testDestroyApiJson()
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

    public function testFilterIndexApiJson()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/products', [
            'maker_id' => 1
        ]);

        $response->assertStatus(200);
    }

    public function testFailedFilterIndexApiJson()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/products', [
            'maker_id' => 'string'
        ]);

        $response->assertStatus(422);
    }


    // WEB API
    public function testIndexApiWeb()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function testCreateApiWeb()
    {
        $response = $this->post('/products', [
            'name' => 'Create product WEB',
            'substance_id' => 1,
            'maker_id' => 1,
            'price' => 50,
        ]);

        $response->assertStatus(302);
    }

    public function testUpdateApiWeb()
    {
        $response = $this->patch('/products/5', [
            'name' => 'Update product WEB',
        ]);

        $response->assertStatus(302);
    }

    public function testDestroyApiWeb()
    {
        $response = $this->delete('/products/5');
        $response->assertStatus(302);
    }

    public function testFilterIndexApiWeb()
    {
        $response = $this->json('GET', '/products', [
            'maker_id' => 1,
        ]);

        $response->assertStatus(200);
    }

    public function testFailedFilterIndexApiWeb()
    {
        $response = $this->json('GET', '/products', [
            'maker_id' => 'string',
        ]);

        $response->assertStatus(422);
    }
}
