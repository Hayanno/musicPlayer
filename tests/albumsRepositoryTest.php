<?php

use App\Models\albums;
use App\Repositories\albumsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class albumsRepositoryTest extends TestCase
{
    use MakealbumsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var albumsRepository
     */
    protected $albumsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->albumsRepo = App::make(albumsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatealbums()
    {
        $albums = $this->fakealbumsData();
        $createdalbums = $this->albumsRepo->create($albums);
        $createdalbums = $createdalbums->toArray();
        $this->assertArrayHasKey('id', $createdalbums);
        $this->assertNotNull($createdalbums['id'], 'Created albums must have id specified');
        $this->assertNotNull(albums::find($createdalbums['id']), 'albums with given id must be in DB');
        $this->assertModelData($albums, $createdalbums);
    }

    /**
     * @test read
     */
    public function testReadalbums()
    {
        $albums = $this->makealbums();
        $dbalbums = $this->albumsRepo->find($albums->id);
        $dbalbums = $dbalbums->toArray();
        $this->assertModelData($albums->toArray(), $dbalbums);
    }

    /**
     * @test update
     */
    public function testUpdatealbums()
    {
        $albums = $this->makealbums();
        $fakealbums = $this->fakealbumsData();
        $updatedalbums = $this->albumsRepo->update($fakealbums, $albums->id);
        $this->assertModelData($fakealbums, $updatedalbums->toArray());
        $dbalbums = $this->albumsRepo->find($albums->id);
        $this->assertModelData($fakealbums, $dbalbums->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletealbums()
    {
        $albums = $this->makealbums();
        $resp = $this->albumsRepo->delete($albums->id);
        $this->assertTrue($resp);
        $this->assertNull(albums::find($albums->id), 'albums should not exist in DB');
    }
}
