<?php

namespace App\Repositories;

use App\Models\artists;
use InfyOm\Generator\Common\BaseRepository;

class artistsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return artists::class;
    }
}
