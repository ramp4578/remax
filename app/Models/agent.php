<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class agent
 * @package App\Models
 * @version October 4, 2017, 3:25 am UTC
 *
 * @property string venture
 * @property string name
 * @property string number
 * @property string email
 * @property string image
 */
class agent extends Model
{
    use SoftDeletes;

    public $table = 'agents';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'venture',
        'name',
        'number',
        'email',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'venture' => 'string',
        'name' => 'string',
        'number' => 'string',
        'email' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'venture' => 'required',
        'name' => 'required',
        'number' => 'numeric',
        'email' => 'email',
        'image' => 'required'
    ];

    
}
