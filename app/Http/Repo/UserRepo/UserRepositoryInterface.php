<?php


namespace App\Http\Repo\UserRepo;


use App\Http\Repo\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAdminByType($type);

    public function store($request);

    public function update($obj, $request   );
}
