<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tracksApiTest extends TestCase
{
    use MaketracksTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetracks()
    {
        $tracks = $this->faketracksData();
        $this->json('POST', '/api/v1/tracks', $tracks);

        $this->assertApiResponse($tracks);
    }

    /**
     * @test
     */
    public function testReadtracks()
    {
        $tracks = $this->maketracks();
        $this->json('GET', '/api/v1/tracks/'.$tracks->id);

        $this->assertApiResponse($tracks->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetracks()
    {
        $tracks = $this->maketracks();
        $editedtracks = $this->faketracksData();

        $this->json('PUT', '/api/v1/tracks/'.$tracks->id, $editedtracks);

        $this->assertApiResponse($editedtracks);
    }

    /**
     * @test
     */
    public function testDeletetracks()
    {
        $tracks = $this->maketracks();
        $this->json('DELETE', '/api/v1/tracks/'.$tracks->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tracks/'.$tracks->id);

        $this->assertResponseStatus(404);
    }
}
