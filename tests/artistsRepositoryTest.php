<?php

use App\Models\artists;
use App\Repositories\artistsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class artistsRepositoryTest extends TestCase
{
    use MakeartistsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var artistsRepository
     */
    protected $artistsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->artistsRepo = App::make(artistsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateartists()
    {
        $artists = $this->fakeartistsData();
        $createdartists = $this->artistsRepo->create($artists);
        $createdartists = $createdartists->toArray();
        $this->assertArrayHasKey('id', $createdartists);
        $this->assertNotNull($createdartists['id'], 'Created artists must have id specified');
        $this->assertNotNull(artists::find($createdartists['id']), 'artists with given id must be in DB');
        $this->assertModelData($artists, $createdartists);
    }

    /**
     * @test read
     */
    public function testReadartists()
    {
        $artists = $this->makeartists();
        $dbartists = $this->artistsRepo->find($artists->id);
        $dbartists = $dbartists->toArray();
        $this->assertModelData($artists->toArray(), $dbartists);
    }

    /**
     * @test update
     */
    public function testUpdateartists()
    {
        $artists = $this->makeartists();
        $fakeartists = $this->fakeartistsData();
        $updatedartists = $this->artistsRepo->update($fakeartists, $artists->id);
        $this->assertModelData($fakeartists, $updatedartists->toArray());
        $dbartists = $this->artistsRepo->find($artists->id);
        $this->assertModelData($fakeartists, $dbartists->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteartists()
    {
        $artists = $this->makeartists();
        $resp = $this->artistsRepo->delete($artists->id);
        $this->assertTrue($resp);
        $this->assertNull(artists::find($artists->id), 'artists should not exist in DB');
    }
}
