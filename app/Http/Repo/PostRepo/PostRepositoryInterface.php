<?php
namespace App\Http\Repo\PostRepo;

use App\Http\Repo\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getPostCategory();

    public function store($request);

    public function update($request, $obj);

}
