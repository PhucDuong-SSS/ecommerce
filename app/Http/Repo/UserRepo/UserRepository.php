<?php


namespace App\Http\Repo\UserRepo;


use App\Http\Repo\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    function getAll()
    {
        // TODO: Implement getAll() method.
    }
}
