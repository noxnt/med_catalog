<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MakerTest extends TestCase
{
    use DatabaseTransactions;

    // Status
    public function testStatusIndex()
    {
        $response = $this->get('/makers');
        $response->assertStatus(200);
    }

    public function testStatusEdit()
    {
        $response = $this->get('/makers/1/edit');
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
        ])->json('GET', '/makers');

        $response->assertStatus(200);
    }

    public function testCreateApiJson()
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

    public function testUpdateApiJson()
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

    public function testFilterIndexApiJson()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/makers', [
            'name' => '*',
        ]);

        $response->assertStatus(200);
    }

    public function testFailedFilterIndexApiJson()
    {
        $response = $this->withHeaders([
            'Accept' => '/json',
        ])->json('GET', '/makers', [
            'name' => 1,
        ]);

        $response->assertStatus(422);
    }


    // WEB API
    public function testIndexApiWeb()
    {
        $response = $this->get('/makers');
        $response->assertStatus(200);
    }

    public function testCreateApiWeb()
    {
        $response = $this->post('/makers', [
            'name' => 'Create maker WEB',
        ]);

        $response->assertStatus(302);
    }

    public function testUpdateApiWeb()
    {
        $response = $this->patch('/makers/5', [
            'name' => 'Update maker WEB',
        ]);

        $response->assertStatus(302);
    }

    public function testDestroyApiWeb()
    {
        $response = $this->delete('/makers/5');
        $response->assertStatus(302);
    }

    public function testFilterIndexApiWeb()
    {
        $response = $this->json('GET', '/makers', [
            'name' => '*',
        ]);

        $response->assertStatus(200);
    }

    public function testFailedFilterIndexApiWeb()
    {
        $response = $this->json('GET', '/makers', [
            'name' => true,
        ]);

        $response->assertStatus(422);
    }
}
