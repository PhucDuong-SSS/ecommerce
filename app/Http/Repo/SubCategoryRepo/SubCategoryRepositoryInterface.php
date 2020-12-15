<?php
namespace App\Http\Repo\SubCategoryRepo;

use App\Http\Repo\RepositoryInterface;

interface SubCategoryRepositoryInterface extends RepositoryInterface
{
    public function create($request);

    public function update($request, $obj);

}
