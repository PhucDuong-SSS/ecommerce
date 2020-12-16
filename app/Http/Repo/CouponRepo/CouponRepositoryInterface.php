<?php
namespace App\Http\Repo\CouponRepo;

use App\Http\Repo\RepositoryInterface;

interface CouponRepositoryInterface extends RepositoryInterface
{
    public function create($request);
    public function update($request,$obj);
}
