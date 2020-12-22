<?php
namespace App\Http\Repo\ContactRepo;

use App\Http\Repo\RepositoryInterface;

interface ContactRepositoryInterface extends RepositoryInterface
{
    public function store($request);
}
