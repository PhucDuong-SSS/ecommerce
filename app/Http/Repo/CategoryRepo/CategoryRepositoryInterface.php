<?php
namespace App\Http\Repo\CategoryRepo;


use App\Http\Repo\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function create($request);

    public function update($request, $obj);

}

