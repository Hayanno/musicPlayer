<?php

namespace App\Repositories;

use App\Models\tracks;
use InfyOm\Generator\Common\BaseRepository;

class tracksRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'art',
        'file'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return tracks::class;
    }
}
