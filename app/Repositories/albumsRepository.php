<?php

namespace App\Repositories;

use App\Models\albums;
use InfyOm\Generator\Common\BaseRepository;

class albumsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'art'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return albums::class;
    }
}
