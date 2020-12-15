<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 */

class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id',$id)->first();
    }

}

