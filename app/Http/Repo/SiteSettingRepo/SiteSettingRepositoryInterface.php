<?php
namespace App\Http\Repo\SiteSettingRepo;

use App\Http\Repo\RepositoryInterface;

interface SiteSettingRepositoryInterface extends RepositoryInterface
{

    public function update($request, $obj);
}
