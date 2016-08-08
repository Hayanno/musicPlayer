<?php

use Faker\Factory as Faker;
use App\Models\tracks;
use App\Repositories\tracksRepository;

trait MaketracksTrait
{
    /**
     * Create fake instance of tracks and save it in database
     *
     * @param array $tracksFields
     * @return tracks
     */
    public function maketracks($tracksFields = [])
    {
        /** @var tracksRepository $tracksRepo */
        $tracksRepo = App::make(tracksRepository::class);
        $theme = $this->faketracksData($tracksFields);
        return $tracksRepo->create($theme);
    }

    /**
     * Get fake instance of tracks
     *
     * @param array $tracksFields
     * @return tracks
     */
    public function faketracks($tracksFields = [])
    {
        return new tracks($this->faketracksData($tracksFields));
    }

    /**
     * Get fake data of tracks
     *
     * @param array $postFields
     * @return array
     */
    public function faketracksData($tracksFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'file' => $fake->word,
            'art' => $fake->word,
            'title' => $fake->word
        ], $tracksFields);
    }
}
