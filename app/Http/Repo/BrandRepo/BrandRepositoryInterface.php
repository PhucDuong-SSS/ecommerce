<?php
namespace App\Http\Repo\BrandRepo;
use App\Http\Repo\RepositoryInterface;

interface BrandRepositoryInterface extends RepositoryInterface
{
    public function create($request);

    public function update($request, $obj );
}
