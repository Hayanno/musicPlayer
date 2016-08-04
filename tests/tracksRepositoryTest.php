<?php

use App\Models\tracks;
use App\Repositories\tracksRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tracksRepositoryTest extends TestCase
{
    use MaketracksTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var tracksRepository
     */
    protected $tracksRepo;

    public function setUp()
    {
        parent::setUp();
        $this->tracksRepo = App::make(tracksRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetracks()
    {
        $tracks = $this->faketracksData();
        $createdtracks = $this->tracksRepo->create($tracks);
        $createdtracks = $createdtracks->toArray();
        $this->assertArrayHasKey('id', $createdtracks);
        $this->assertNotNull($createdtracks['id'], 'Created tracks must have id specified');
        $this->assertNotNull(tracks::find($createdtracks['id']), 'tracks with given id must be in DB');
        $this->assertModelData($tracks, $createdtracks);
    }

    /**
     * @test read
     */
    public function testReadtracks()
    {
        $tracks = $this->maketracks();
        $dbtracks = $this->tracksRepo->find($tracks->id);
        $dbtracks = $dbtracks->toArray();
        $this->assertModelData($tracks->toArray(), $dbtracks);
    }

    /**
     * @test update
     */
    public function testUpdatetracks()
    {
        $tracks = $this->maketracks();
        $faketracks = $this->faketracksData();
        $updatedtracks = $this->tracksRepo->update($faketracks, $tracks->id);
        $this->assertModelData($faketracks, $updatedtracks->toArray());
        $dbtracks = $this->tracksRepo->find($tracks->id);
        $this->assertModelData($faketracks, $dbtracks->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetracks()
    {
        $tracks = $this->maketracks();
        $resp = $this->tracksRepo->delete($tracks->id);
        $this->assertTrue($resp);
        $this->assertNull(tracks::find($tracks->id), 'tracks should not exist in DB');
    }
}
