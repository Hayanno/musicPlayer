<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class albumsApiTest extends TestCase
{
    use MakealbumsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatealbums()
    {
        $albums = $this->fakealbumsData();
        $this->json('POST', '/api/v1/albums', $albums);

        $this->assertApiResponse($albums);
    }

    /**
     * @test
     */
    public function testReadalbums()
    {
        $albums = $this->makealbums();
        $this->json('GET', '/api/v1/albums/'.$albums->id);

        $this->assertApiResponse($albums->toArray());
    }

    /**
     * @test
     */
    public function testUpdatealbums()
    {
        $albums = $this->makealbums();
        $editedalbums = $this->fakealbumsData();

        $this->json('PUT', '/api/v1/albums/'.$albums->id, $editedalbums);

        $this->assertApiResponse($editedalbums);
    }

    /**
     * @test
     */
    public function testDeletealbums()
    {
        $albums = $this->makealbums();
        $this->json('DELETE', '/api/v1/albums/'.$albums->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/albums/'.$albums->id);

        $this->assertResponseStatus(404);
    }
}
