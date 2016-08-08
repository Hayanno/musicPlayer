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
        'title'
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
}
