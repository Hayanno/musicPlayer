<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="albums",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="art",
 *          description="art",
 *          type="string"
 *      )
 *      @SWG\Property(
 *          property="artists",
 *          description="artists",
 *          type="artist"
 *      )
 *      @SWG\Property(
 *          property="tracks",
 *          description="tracks",
 *          type="tracks"
 *      )
 * )
 */
class albums extends Model
{
    use SoftDeletes;

    public $table = 'albums';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'art'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'art' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * The artists that belong to the album
     */
    public function artists() {
        return $this->belongsToMany('App\artists');
    }

    /**
     * The tracks that belong to the album
     */
    public function tracks() {
        return $this->belongsToMany('App\tracks');
    }
}
