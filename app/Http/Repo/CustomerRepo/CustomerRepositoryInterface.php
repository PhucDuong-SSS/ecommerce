<?php
namespace App\Http\Repo\CustomerRepo;

use App\Http\Repo\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function create($request);
}
