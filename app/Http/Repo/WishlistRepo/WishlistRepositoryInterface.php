<?php
namespace App\Http\Repo\WishlistRepo;

use App\Http\Repo\RepositoryInterface;

interface WishlistRepositoryInterface extends RepositoryInterface
{
    public function check($id);
    public function checkLogin();
    public function store($id);
    public function count();

}
