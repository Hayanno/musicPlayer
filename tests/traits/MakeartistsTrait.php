<?php

use Faker\Factory as Faker;
use App\Models\artists;
use App\Repositories\artistsRepository;

trait MakeartistsTrait
{
    /**
     * Create fake instance of artists and save it in database
     *
     * @param array $artistsFields
     * @return artists
     */
    public function makeartists($artistsFields = [])
    {
        /** @var artistsRepository $artistsRepo */
        $artistsRepo = App::make(artistsRepository::class);
        $theme = $this->fakeartistsData($artistsFields);
        return $artistsRepo->create($theme);
    }

    /**
     * Get fake instance of artists
     *
     * @param array $artistsFields
     * @return artists
     */
    public function fakeartists($artistsFields = [])
    {
        return new artists($this->fakeartistsData($artistsFields));
    }

    /**
     * Get fake data of artists
     *
     * @param array $postFields
     * @return array
     */
    public function fakeartistsData($artistsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word
        ], $artistsFields);
    }
}
