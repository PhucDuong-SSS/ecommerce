<?php
namespace App\Http\Repo\PostCategoryRepo ;

use App\Http\Repo\RepositoryInterface;

interface PostCategoryRepositoryInterface extends RepositoryInterface
{
    public function create($request);

    public function update($request, $obj);

}
