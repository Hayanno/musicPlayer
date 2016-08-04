<?php

use Faker\Factory as Faker;
use App\Models\albums;
use App\Repositories\albumsRepository;

trait MakealbumsTrait
{
    /**
     * Create fake instance of albums and save it in database
     *
     * @param array $albumsFields
     * @return albums
     */
    public function makealbums($albumsFields = [])
    {
        /** @var albumsRepository $albumsRepo */
        $albumsRepo = App::make(albumsRepository::class);
        $theme = $this->fakealbumsData($albumsFields);
        return $albumsRepo->create($theme);
    }

    /**
     * Get fake instance of albums
     *
     * @param array $albumsFields
     * @return albums
     */
    public function fakealbums($albumsFields = [])
    {
        return new albums($this->fakealbumsData($albumsFields));
    }

    /**
     * Get fake data of albums
     *
     * @param array $postFields
     * @return array
     */
    public function fakealbumsData($albumsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'art' => $fake->word
        ], $albumsFields);
    }
}
