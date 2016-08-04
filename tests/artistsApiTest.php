<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class artistsApiTest extends TestCase
{
    use MakeartistsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateartists()
    {
        $artists = $this->fakeartistsData();
        $this->json('POST', '/api/v1/artists', $artists);

        $this->assertApiResponse($artists);
    }

    /**
     * @test
     */
    public function testReadartists()
    {
        $artists = $this->makeartists();
        $this->json('GET', '/api/v1/artists/'.$artists->id);

        $this->assertApiResponse($artists->toArray());
    }

    /**
     * @test
     */
    public function testUpdateartists()
    {
        $artists = $this->makeartists();
        $editedartists = $this->fakeartistsData();

        $this->json('PUT', '/api/v1/artists/'.$artists->id, $editedartists);

        $this->assertApiResponse($editedartists);
    }

    /**
     * @test
     */
    public function testDeleteartists()
    {
        $artists = $this->makeartists();
        $this->json('DELETE', '/api/v1/artists/'.$artists->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/artists/'.$artists->id);

        $this->assertResponseStatus(404);
    }
}
