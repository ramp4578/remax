<?php

namespace App\Repositories;

use App\Models\agent;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class agentRepository
 * @package App\Repositories
 * @version October 4, 2017, 3:25 am UTC
 *
 * @method agent findWithoutFail($id, $columns = ['*'])
 * @method agent find($id, $columns = ['*'])
 * @method agent first($columns = ['*'])
*/
class agentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'venture',
        'name',
        'number',
        'email',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return agent::class;
    }
}
