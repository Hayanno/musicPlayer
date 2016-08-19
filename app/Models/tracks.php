<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="tracks",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="file",
 *          description="file",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="art",
 *          description="art",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      )
 * )
 */
class tracks extends Model
{
    use SoftDeletes;

    public $table = 'tracks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'file',
        'art',
        'title',
        'artists',
        'albums'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'file' => 'string',
        'art' => 'string',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * The albums that belong to the artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function albums() {
        return $this->belongsToMany('App\Models\albums');
    }

    /**
     * The artists that belong to the album
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artists() {
        return $this->belongsToMany('App\Models\artists');
    }

    /**
     * Get a list of artists ids associated with the current track
     *
     * @return array
     */
    public function getArtistsListAttribute() {
        return $this->artists->pluck('id')->all();
    }
}
