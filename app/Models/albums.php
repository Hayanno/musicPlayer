<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="albums",
 *      required={"title"},
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
        'title' => 'required'
    ];
}
